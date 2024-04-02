async function SetTeam() {

    fetch("http://localhost/vizsgaA/index.php?method=TEAM",
        {
            method: "POST",
            headers:
            {
                "Content-type": "application/json"
            },
            body: JSON.stringify(
                {
                    "csapatnev": document.getElementById("csapatnev").value,
                    "edzo": document.getElementById("edzo").value,
                    "kapitany": document.getElementById("kapitany").value
                })
        })
        .then(apiresponse => apiresponse.json())
        .then(response => {
            console.log(response);
            var target = document.getElementById("result");
            if (response.hasOwnProperty("error")) {
                target.innerHTML = response.error;
                target.setAttribute("class", "error");
            }
            else {
                target.innerHTML = response.result;
                target.setAttribute("class", "success");
                GetTeams();
            }
        });
}

async function GetTeams() {

    fetch("http://localhost/vizsgaA/index.php?method=TEAM",
        {
            method: "GET"
        })
        .then(apiresponse => apiresponse.json())
        .then(jsonData => {

            console.log(jsonData);
            var dtable = document.getElementById("teamTable");
            dtable.innerHTML = "";
            var table = document.createElement("table");
            var header = document.createElement("tr");
            var id = document.createElement("th");
            id.innerHTML = "Azonosító";
            var csapat = document.createElement("th");
            csapat.innerHTML = "Csapat név";
            var edzo = document.createElement("th");
            edzo.innerHTML = "Edző";
            var kapitany = document.createElement("th");
            kapitany.innerHTML = "Csapatkapitány";
            var mod = document.createElement("th");
            mod.innerHTML = "Módosítás";
            header.appendChild(id);
            header.appendChild(csapat);
            header.appendChild(edzo);
            header.appendChild(kapitany);
            header.appendChild(mod);
            table.appendChild(header);
            for (var i = 0; i < jsonData.length; i++) {

                var row = document.createElement("tr");
                var id = document.createElement("td");
                id.innerHTML = jsonData[i].id;

                var csapat = document.createElement("td");
                csapat.innerHTML = jsonData[i].csapatnev;

                var edzo = document.createElement("td");
                edzo.innerHTML = jsonData[i].edzo;

                var kapitany = document.createElement("td");
                kapitany.innerHTML = jsonData[i].kapitany;

                var modteam = document.createElement("td");
                modteam.innerHTML = "<button onclick=\"FormForTeam(" + jsonData[i].id + ");\">Módosítás</button>";

                row.appendChild(id);
                row.appendChild(csapat);
                row.appendChild(edzo);
                row.appendChild(kapitany);
                row.appendChild(modteam);
                table.appendChild(row);
            }
            dtable.appendChild(table);
        });
}

async function FormForTeam(id) {
    fetch("http://localhost/vizsgaA/index.php?method=TEAMS&id=" + id,
        {
            method: "GET"
        })
        .then(apiresponse => apiresponse.json())
        .then(response => {
            console.log(response);
            if (response.hasOwnProperty("error")) {
                var target = document.getElementById("result");
                target.innerHTML = response.error;
                target.setAttribute("class", "error");
            }
            else {
                document.getElementById("csapatnev").value = response.csapatnev;
                document.getElementById("edzo").value = response.edzo;
                document.getElementById("kapitany").value = response.kapitany;
                var button = document.getElementById("DoCall");
                button.innerHTML = "Módosítás";
                button.setAttribute("onclick", "ModifyTeam(" + response.id + ");");
            }
        });
}

async function ModifyTeam(id) {

    fetch("http://localhost/vizsgaA/index.php?method=TEAMS&id=" + id,
        {
            method: "PUT",
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify(
                {
                    "csapatnev": document.getElementById("csapatnev").value,
                    "edzo": document.getElementById("edzo").value,
                    "kapitany": document.getElementById("kapitany").value
                })
        })
        .then(apiresponse => apiresponse.json())
        .then(response => {

            console.log(response);
            var target = document.getElementById("result");
            if (response.hasOwnProperty("error")) {
                target.innerHTML = response.error;
                target.setAttribute("class", "error");
            }
            else {
                target.innerHTML = response.result;
                target.setAttribute("class", "success");
                GetTeams();
                document.getElementById("csapatnev").value = "";
                document.getElementById("edzo").value = "";
                document.getElementById("kapitany").value = "";
                var button = document.getElementById("DoCall");
                button.innerHTML = "Csapat rögzítése";
                button.setAttribute("onclick", "SetTeam();");
            }
        });
}

async function GetSelecting() {

    fetch("http://localhost/vizsgaA/index.php?method=TEAM",
        {
            method: "GET"
        })
        .then(apiresponse => apiresponse.json())
        .then(jsonData => {
            console.log(jsonData);
            var selecting = document.getElementById("selectteam");

            var select = document.createElement("select");
            for (var i = 0; i < jsonData.length; i++) {
                var option = document.createElement("option");
                option.innerHTML = jsonData[i].csapatnev;
                option.value = jsonData[i].csapatnev;
                option.id = jsonData[i].id;
                select.appendChild(option);
            }
            selecting.appendChild(select);
        });
}


async function SetResult() {

    fetch("http://localhost/vizsgaA/index.php?method=RESULT",
        {
            method: "POST",
            headers:
            {
                "Content-type": "application/json"
            },
            body: JSON.stringify(
                {
                    "selectteam": document.querySelector("option").value,
                    "eredmeny": document.getElementById("eredmeny").value,
                    "datum": document.getElementById("datum").value,
                    "gol": document.getElementById("gol").value,
                    "ido": document.getElementById("ido").value,
                    "lovo": document.getElementById("lovo").value
                })
        })
        .then(apiresponse => apiresponse.json())
        .then(response => {
            console.log(response);
            var target = document.getElementById("result");
            if (response.hasOwnProperty("error")) {
                target.innerHTML = response.error;
                target.setAttribute("class", "error");
            }
            else {
                target.innerHTML = response.result;
                target.setAttribute("class", "success");
            }
        });
}




async function GetResults() {

    fetch("http://localhost/vizsgaA/index.php?method=MAIN",
        {
            method: "GET"
        })
        .then(apiresponse => apiresponse.json())
        .then(jsonData => {

            console.log(jsonData);
            var dtable = document.getElementById("getResults");
            dtable.innerHTML = "";
            var table = document.createElement("table");
            var header = document.createElement("tr");

            var id = document.createElement("th");
            id.innerHTML = "Azonosító";

            var csapat = document.createElement("th");
            csapat.innerHTML = "Csapat";

            var eredmeny = document.createElement("th");
            eredmeny.innerHTML = "Eredmény";


            header.appendChild(csapat);
            header.appendChild(eredmeny);
            table.appendChild(header);
            for (var i = 0; i < jsonData.length; i++) {

                var row = document.createElement("tr");
                var id = document.createElement("td");
                row.setAttribute("ondblclick", "MoreDetails(" + jsonData[i].id + ");");

                var csapat = document.createElement("td");
                csapat.innerHTML = jsonData[i].selectteam;

                var eredmeny = document.createElement("td");
                eredmeny.innerHTML = jsonData[i].eredmeny;

                row.appendChild(csapat);
                row.appendChild(eredmeny);
                table.appendChild(row);
            }
            dtable.appendChild(table);
        });
}


async function MoreDetails(id) {

    fetch("http://localhost/vizsgaA/index.php?method=DETAILS&id=" + id,
        {
            method: "GET"
        })
        .then(apiresponse => apiresponse.json())
        .then(jsonData => {

            console.log(jsonData);
            var dtable = document.getElementById("infoResult");
            dtable.style.display = "block";
            dtable.innerHTML = "";

            var table = document.createElement("table");
            var header = document.createElement("tr");

            var id = document.createElement("th");
            id.innerHTML = "Azonosító";

            var csapat = document.createElement("th");
            csapat.innerHTML = "Csapat";

            var eredmeny = document.createElement("th");
            eredmeny.innerHTML = "Eredmény";

            var datum = document.createElement("th");
            datum.innerHTML = "Dátum";

            var gol = document.createElement("th");
            gol.innerHTML = "Gól";

            var ido = document.createElement("th");
            ido.innerHTML = "Idő";

            var lovo = document.createElement("th");
            lovo.innerHTML = "Gól lövő";

            header.appendChild(id);
            header.appendChild(csapat);
            header.appendChild(eredmeny);
            header.appendChild(datum);
            header.appendChild(gol);
            header.appendChild(ido);
            header.appendChild(lovo);
            table.appendChild(header);

            for (var i = 0; i < jsonData.length; i++) {

                var row = document.createElement("tr");
                var id = document.createElement("td");
                id.innerHTML = jsonData[i].id;

                var csapat = document.createElement("td");
                csapat.innerHTML = jsonData[i].selectteam;

                var eredmeny = document.createElement("td");
                eredmeny.innerHTML = jsonData[i].eredmeny;

                var datum = document.createElement("td");
                datum.innerHTML = jsonData[i].datum;

                var gol = document.createElement("td");
                gol.innerHTML = jsonData[i].gol;

                var ido = document.createElement("td");
                ido.innerHTML = jsonData[i].ido;

                var lovo = document.createElement("td");
                lovo.innerHTML = jsonData[i].lovo;

                row.appendChild(id);
                row.appendChild(csapat);
                row.appendChild(eredmeny);
                row.appendChild(datum);
                row.appendChild(gol);
                row.appendChild(ido);
                row.appendChild(lovo);
                table.appendChild(row);
            }
            dtable.appendChild(table);
        });
}
