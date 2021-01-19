
<form action="/register" method="POST">

    {{csrf_field()}}
    <label for="first_name">Name:</label>
    <input type="text" id="first_name" name="first_name">
    </br>
    <label for="last_name">last_name:</label>
    <input type="text" id="last_name" name="last_name">
    </br>
    <label for="email">email:</label>
    <input type="text" id="email" name="email"  style="text-align: left;direction:ltr;">
    </br>
    <label for="mobile">mobile:</label>
    <input type="text" id="mobile" name="mobile" style="text-align: left;direction:ltr;">
    </br>
    <label for="password">password:</label>
    <input type="password" id="password" name="password" style="text-align: left;direction:ltr;">
    </br>
    <label for="password_confirmation">password confirmation:</label>
    <input type="password" id="password_confirmation" name="password_confirmation"  style="text-align: left;direction:ltr;">
    </br>


    <button type="submit">Register</button>
</form>