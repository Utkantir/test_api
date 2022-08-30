<!DOCTYPE html>
<html>
<head>
    <title>It works!</title>
    <style>
        .wrapper {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
            grid-auto-rows: minmax(50px, auto);
        }
        .form {
            grid-column: 1 / 2;
            grid-row: 1;
            text-align: left;
        }
        .errors {
            grid-column: 1 / 2;
            grid-row: 2;
            text-align: left;
        }
        .button {
            grid-column: 2 / 2;
            grid-row: 1;
            text-align: left;
        }

        #success{
            color: green;
            display: block;
            height: 5px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
<div id="form" class="form">
    <form>
        <label for="email">Email</label><br>
        <input type="email" id="email" required><br>

        <label for="name">ФИО</label><br>
        <input type="text" id="name" required><br>

        <label for="age">Возраст</label><br>
        <input type="number" min="14" max="150" id="age" required><br>

        <label for="work_experience">Стаж работы</label><br>
        <input type="number" max="150" id="work_experience" required><br>

        <label for="photo">Фото</label><br>
        <input type="text" id="photo"><br>

        <label for="average_salary">средняя з/п</label><br>
        <input type="number" id="average_salary" required>

        <p id="success"></p>
        <input type="submit" value="Submit">
    </form>

</div>
<div id="button" class="button">
    <button>All Employees</button>
    <div id="list" class="list">
    </div>
</div>

<div id="errors" class="errors">

</div>
</div>
<script>
    $(document).ready(function(){
        $(document).ajaxError(function(e, xhr){
            $("#errors").html(`<h3>${xhr.status} ${xhr.statusText}</h3>`);
            if(xhr.responseJSON&&xhr.responseJSON.errors) {
                for (const [key, value] of Object.entries(xhr.responseJSON.errors)) {
                    $('<p>' + key + ': ' + value + '</p>').appendTo('#errors');
                }
            }
        });
        $("form").submit(function(event){
            $.post("{{ url('/api/employees') }}",
                {
                    email: $("#email").val(),
                    name: $("#name").val(),
                    age: $("#age").val(),
                    work_experience: $("#work_experience").val(),
                    photo: $("#photo").val(),
                    average_salary: $("#average_salary").val()
                },
                function(data,status){
                    $("#success").text(status);
                }, "json")
                .fail(function(){
                    $("#success").text("");
                });
            event.preventDefault();
        });
        $("button").click(function(){
            $.get("{{ url('/api/employees') }}", function(data, status){
                if (status == "success" && data && data.length > 0){
                    $("#list").html("<ul>");
                    data.forEach(function (item){
                        $("#list").append(
                            "<li id="+item.id+" onclick=getThisOne("+item.id+")>"+
                            "name: " + item.name+
                            "<br> age: " + item.age+
                            "<br> work_experience: " + item.work_experience+
                            "<br> photo: " + item.photo+
                            "<br> average_salary: " + item.average_salary+
                            "<br> email: " + item.email+
                            "</li><br> ");
                    })
                    $("#list").append("</ul>");
                }
            }).done(function pshe (){
            });
        });
    });
    function getThisOne (id){
        $.get("{{ url('/api/employees') }}"+"/"+id, function(data, status){
            if (status == "success" && data){
                $("#list").html("<p> id="+data.id+""+
                    "<br> name: " + data.name+
                    "<br> age: " + data.age+
                    "<br> work_experience: " + data.work_experience+
                    "<br> photo: " + data.photo+
                    "<br> average_salary: " + data.average_salary+
                    "<br> email: " + data.email
                );
            }
        });
    };

</script>
</body>
</html>
