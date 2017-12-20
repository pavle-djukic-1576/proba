<!DOCTYPE html>
<html lang="en">
<head>
    <title>Adresar</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{!! asset('js/scr.js') !!}"></script>



</head>


<body onload="loadData();">


<nav class="navbar navbar-default mainNav">
    <div class="container-fluid">

        <!-- Naslov-->
        <div class="navbar-header">
            <a class="navbar-brand"> ADRESAR </a>
        </div>

        <!-- Glavni meni-->
        <div>
            <ul class="nav navbar-nav">
                <li class="active"> <a href="#adressTable"> Tabela </a></li>
                <li><a href="#form1"> Forma </a> </li>
            </ul>

        </div>

    </div>
</nav>

<!-- Velika slika-->
<div class="wide headImg ">
    <img  id="mainImg" class="img-responsive" src="images/bg-adres.png">
</div>

<!-- Kolone -->
<div class="container informations">

    <div class="col-md-4">
        <blockquote class="alert-info">
            <span class="glyphicon glyphicon-ok-sign col-md-offset-5"></span>
            <p> Kreirajte svoju bazu kontakta! </p>
            <footer>brzo i jednostavno kreirajte bazu sa adresnim podacima  i budite sigurni da su na bezbednom mestu u našoj bazi podataka. </footer>
        </blockquote>
    </div>

    <div class="col-md-4">
        <blockquote class="alert-info">
            <span class="glyphicon  glyphicon glyphicon-dashboard col-md-offset-5"></span>
            <p> Brzo i pregledno unesite podatke! </p>
            <footer> Pregledan korisnički interface vam omogućava da brzo prikupite svoje adrese na jedno mesto.</footer>
        </blockquote>
    </div>


    <div class="col-md-4">
        <blockquote class="alert-info">
            <span class="glyphicon glyphicon-road col-md-offset-5"></span>
            <p>Aplikacija se stalno ažurira u skladu sa Vašim zahtevima</p>
            <footer>cilj nam je da aplikaciju približimo korisniku pa je svaka Vaša sugestija korisna</footer>
        </blockquote>
    </div>
</div>

<div class="container main-body table-bordered bg-primary">



                        <!----------------------------FORMA ZA UNOS------------------------------------------->


    {{csrf_field()}}
</br>
    <div id= 'form1' class="formaStyle form-group col-md-4">
        <h4>IME:</h4> <input type="text" id="imeInp" name="ime" class="form-control"> <br/>
        <h4>Prezime:</h4> <input type="text" id="prezimeInp" name="prezime" class="form-control"><br/>
        <h4>Pol:</h4>

    <select id="polInp" class="form-control">
        <option value="muški" >Muški</option>
        <option value="ženski">Ženski</option>
    </select><br/>
        <h4 class="hidden-sm hidden-xs">Ulica i broj:</h4> <input type="text" id="ulicaBrInp"  name="ulicaBr" class="form-control hidden-sm hidden-xs"><br/>
        <h4  class="hidden-sm hidden-xs" >Poštanski broj</h4><input type="number" id="postBrInp" name="postBr" class="form-control hidden-sm hidden-xs"><br/>
        <h4>Grad:</h4> <input type="text" id="gradInp"  name="grad" class="form-control"><br/>
        <h4>Zemlja:</h4> <input type="text" id="zemljaInp"  name="zemlja" class="form-control"><br/>
    <div class="checkbox col-md-12">
        <h4>Punoletan:
        <input type="checkbox" id="punoletanInp" name="punoletan"></h4>
    </div>
    </div>
    <div class="formaStyle form-group col-md-12">
    <button id="submitBtn" class="button btn-primary btn-block col-md-12" > Sačuvaj </button>
    <!--<input type="submit" value="Potvrdi unos" >-->
    <input type="hidden" class='editDiv' id="">
    </div>
                    <!----------------------------FORMA ZA UNOS------------------------------------------->

    </br></br>
<div class="mainTable col-xm-12">
    <table border="1" id="adressTable" class="table table-responsive table-striped ">
        <tr>
            <th scope="col">Ime</th>
            <th scope="col">Prezime</th>
            <th scope="col">Pol</th>
            <th scope="col">Ulica i Broj</th>
            <th scope="col">Poštanski broj</th>
            <th scope="col">Grad</th>
            <th scope="col">Zemlja</th>
            <th scope="col">Punoletan</th>
            <th scope="col">Dugme za brisanje</th>
        </tr>

    </table>
</div>

</div>
</div>
<script type="text/javascript" src="{!! asset('js/scr.js') !!}"></script>
</body>
</html>