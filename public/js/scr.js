
    data = "";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

//f-ja prosledjuje podatke za upis u bazu
    $('#submitBtn').click(function () {
        //console.log("klik");

        $checkBox = document.getElementById("punoletanInp").checked;

        //DODATO provera za prazno ako je prazno upisi "/"

        $imeInp = $('#imeInp').val();
        $prezimeInp = $('#prezimeInp').val();
        $polInp = $('#polInp').val();
        $ulicaBrInp = $('#ulicaBrInp').val();
        $postBrInp= $('#postBrInp').val();
        $gradInp = $('#gradInp').val();
        $zemljaInp = $('#zemljaInp').val();

        $x = -1;

        if ($imeInp == ""){
            alert("Obavezno je uneti ime za osobu")
        }
        if ($prezimeInp == ""){
            $prezimeInp = "/";
        }
        if ($ulicaBrInp == ""){
            $ulicaBrInp = "/";
        }
        if ($postBrInp == ""){
            $postBrInp = $x;
        }
        if ($gradInp == ""){
            $gradInp = "/";
        }
        if ($zemljaInp == ""){
            $zemljaInp = "/";
        }
        //DODATO

        $.ajax({
            url: "/api/store",
            type: "POST",
            data: {
                //radilo
                ime: $imeInp,
                prezime: $prezimeInp,
                pol: $polInp,
                ulica: $ulicaBrInp,
                postanskiBroj: $postBrInp,
                grad: $gradInp,
                zemlja: $zemljaInp,
                punoletan: $checkBox

            },
            success: function (responce) {
                loadData();
                //  alert(responce.message);

            }
        });
    });

//ucitava i ispisuje podatke iz baze
    function loadData() {
        $.ajax({
            url: "/api/loadData",
            type: "POST",
            success: function (responce) {
                data = responce.data;
                $('.tr').remove();
                for (i = 0; i < data.length; i++) {
                    $('#adressTable').append(
                        "<tr class='tr'>"
                        + "<th>" + "<div class='divEdit' id='" + data[i].id + "'>" + data[i].ime + "</div>" + "<input class='iClas" + data[i].id + "' id='hIme" + data[i].id + "' type='hidden'>" + "</div>" + "</th>"
                        + "<th>" + "<div class='divEdit' id='" + data[i].id + "'>" + data[i].prezime + "</div>" + "<input class='iClas" + data[i].id + "' id='hPrezime" + data[i].id + "'type='hidden'>" + "</div>" + "</th>"
                        + "<th>" + "<div class='divEdit' id='" + data[i].id + "'>" + data[i].pol + "</div>" + "<input class='iClas" + data[i].id + "' id='hPol" + data[i].id + "' type='hidden'>" + "</div>" + "</th>"
                        + "<th>" + "<div class='divEdit' id='" + data[i].id + "'>" + data[i].ulica + "</div>" + "<input class='iClas" + data[i].id + "' id='hUlica" + data[i].id + "' type='hidden'>" + "</div>" + "</th>"
                        + "<th>" + "<div class='divEdit' id='" + data[i].id + "'>" + data[i].postanskiBroj + "</div>" + "<input class='nClas" + data[i].id + "' id='hBroj" + data[i].id + "' type='hidden'>" + "</div>" + "</th>"
                        + "<th>" + "<div class='divEdit' id='" + data[i].id + "'>" + data[i].grad + "</div>" + "<input class='iClas" + data[i].id + "' id='hGrad" + data[i].id + "' type='hidden'>" + "</div>" + "</th>"
                        + "<th>" + "<div class='divEdit' id='" + data[i].id + "'>" + data[i].zemlja + "</div>" + "<input class='iClas" + data[i].id + "' id='hZemlja" + data[i].id + "' type='hidden'>" + "</div>" + "</th>"
                        + "<th>" + "<div id='cb"+ data[i].id  +"'> <div class='divEdit' id='" + data[i].id + "'>" + data[i].punoletan + "</div> </div>" + "<input class='cClas" + data[i].id + "' id='hPunoletan" + data[i].id + "' type='hidden'>" + "</div>" + "</th>"
                        //Okidaci za brisanje / cuvanje izmene / cancel
                        + "<th>" +
                        "<button class='delBtn' id='delBtn" + data[i].id + "'> Obriši podatak</button> "
                        + "<input class='butonEdit" + data[i].id + "' value='Sacuvaj'  type='hidden' id='editBtn'> "
                        + "<input class='butonCancel" + data[i].id + "' value='Odustani'  type='hidden' id='cancelBtn'> "
                        + "</th>"
                        + "</tr>")
                    //+"<th>"+ "<div class='divEdit' id='"+data[i].id+"'>"+ data[i].pol + "</div>" +"<input class='iclas"+data[i].id+"' id='hPol"+ data[i].id +"' type='hidden'>"+"</div>" +"</th>"
                }


            }
        });
    }

//brisanje iz baze podataka
    $('body').on('click', '.delBtn', function (event) {

        //$idForDel = event.target.id.charAt(6);
        $idForDel = event.target.id.split("delBtn").pop();
        $.ajax({
            url: "/api/delData",
            type: "POST",
            data: {
                id: $idForDel
            },
            success: function (responce) {
                loadData();
            }
        });


    });


    /******** Mod za editovanje podataka **********/

    $editMode = false;
//Dogadjaj kada se klikne na neku od kolona
    $('body').on('click', '.divEdit', function (event) {

        if ($editMode === false) {
            $editMode = true;

            //id kliknutog diva (id iz baze)
            $clickedDiv = event.target.id;

            //prikazi input polja
            $inputClass = "." + "iClas" + $clickedDiv;
            $checkClass = "." + "cClas" + $clickedDiv;
            $numberClass = "." + "nClas" + $clickedDiv;
            $($inputClass).attr('type', 'text'); //tekstualni input
            $($checkClass).attr('type', 'checkbox'); //checkbox input
            $($numberClass).attr('type', 'number'); //number input

            //skloni del dugme
            $delBtnId = "#delBtn" + $clickedDiv;
            $($delBtnId).hide();

            //prikazi okidace za izmenu
            $buttonEditClass = ".butonEdit" + $clickedDiv;
            $butonCancelClass = ".butonCancel" + $clickedDiv;

            $($buttonEditClass).attr('type', 'button');
            $($butonCancelClass).attr('type', 'button');
            $counter = 1;

            $('#hIme').val("");

            //uzima tekstualnu vrednost checkbox-a iz tabele / if - postavlja stikliran ili ne checkbox
            $cb = $("#cb"+$clickedDiv).find('div').html(); //****


            if($cb == "true"){
                $("#hPunoletan" + $clickedDiv)[0].checked = true;
            }else {
                $("#hPunoletan" + $clickedDiv)[0].checked = false;
            }

        } else {
            alert("potvrdite ili odustanite od promene");
        }
    });

//poziva loadData() i **odustaje od editovanja**
    $('body').on('click', '#cancelBtn', function (event) {
        loadData();
        $editMode = false;
    });

///Update podataka
    $('body').on('click', '#editBtn', function aa(event) {
        $clickedBtnId = event.target.className;
        $id = $clickedBtnId.split("butonEdit").pop();

        //kreiranje id-eva za input polja koja su naknadno generisana kroz AJAX
        $hIme = "#hIme" + $id;
        $hPrezime = "#hPrezime" + $id;
        $hPol = "#hPol" + $id;
        $hUlica = "#hUlica" + $id;
        $hBroj = "#hBroj" + $id;
        $hGrad = "#hGrad" + $id;
        $hZemlja = "#hZemlja" + $id;
        $hPunoletan = "#hPunoletan" + $id;

        //Check Box vrednost true/false
        $punoletan = $($hPunoletan)[0].checked;



        if(($($hPol).val() != "muški" && $($hPol).val() != "ženski")&&($($hPol).val() != "")){
            alert("unos pola mora biti u formatu: muški ili ženski" );
            return;
        }

        $.ajax({
            url: "/api/updateData",
            type: "POST",
            data: {
                id: $id,
                ime: $($hIme).val(),
                //ime: $('#hIme').val(),
                prezime: $($hPrezime).val(),
                pol: $($hPol).val(),
                ulica: $($hUlica).val(),
                postanskiBroj: $($hBroj).val(),
                grad: $($hGrad).val(),
                zemlja: $($hZemlja).val(),
                //punoletan: $($hPunoletan).val()
                punoletan: $punoletan.toString()
            },
            success: function (responce) {
                $editMode = false;
                loadData();
            }
        });
    });

