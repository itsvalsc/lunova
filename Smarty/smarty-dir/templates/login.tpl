<?php include 'header.tpl' ?>
{if $log}
    <form action="http://localhost/lunova/AboutUs/us/" method="post">
        <div class="form-group" style="width: 30rem;">
            <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
            <input type="email" class="form-control" id="Email" name="Email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group" style="width: 30rem;">
            <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
            <input type="password" class="form-control" id="Password"  name="Password" placeholder="Password">
        </div>
        <hr>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
            <label class="form-check-label" for="optionsRadios1">
                Artista
            </label>

        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios1" value="option2" checked="">
            <label class="form-check-label" for="optionsRadios1">
                Utente
            </label>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Submit</button>

        <button type="button" class="btn btn-primary">Accedi</button>
        <hr>
        <button type="button" class="btn btn-secondary">Inscriviti</button>
    </form>

{/if}