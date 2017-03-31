<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Faculty Search Positions</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <h1>Positions</h1>
        <section id="confirmation"></section>
        <form class="ldpforms">
            <fieldset>
                <legend>Position Information</legend>

                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>

                <label for="number">Job Number (<em>Number Only</em>):</label>
                <input type="number" name="number" >

                <label for="department">Department:</label>
                <select name="department" required>
                    <option value="">-- Please Select --</option>
                    <option value="Adverstising">Advertising</option>
                    <option value="Communication Studies">Communication Studies</option>
                    <option value="Communication Training Center">Communication Training Center</option>
                    <option value="Journalism and Electronic Media and Communications">Journalism and Electronic Media and Communications</option>
                    <option value="Public Relations">Public Relations</option>
                </select>

                <label for="chair">Search Chair:</label>
                <input type="text" name="chair" required>
            </fieldset>
            <button type="submit" class="button">Submit</button>
        </form>

        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>
