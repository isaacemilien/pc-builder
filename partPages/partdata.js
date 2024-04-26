// navbar things
const navbar = document.getElementById("navbar");
const sticky = navbar.offsetTop;
// array of parts and display names
const Parts = {
    "cpu": "CPU:",
    "cpu-cooler": "CPU Cooler:",
    "motherboard": "Motherboard:",
    "memory": "Memory/RAM:",
    "external-hard-drive": "Storage:",
    "video-card": "GPU:",
    "case": "Case:",
    "power-supply": "Power Supply/PCU:",
    "os": "Operating System:",
    "monitor": "Monitor:"
}

window.addEventListener("scroll", () => {
    if (window.scrollY >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
})

// setup for table content
const tableContent = document.getElementById("content");
const tableHead = document.getElementById("head");

const partSelected = localStorage.getItem("selecting");

// sorting init
window.addEventListener("load", async () => {
    // Json Load
    const response = await fetch("json/" + partSelected + ".json");
    const json = await response.json();
    // generate the tables
    genTableHeaders(json);
    getTableCont(json);
    const tableButtons = document.querySelectorAll("th button");
    [...tableButtons].map((button) => {
        button.addEventListener("click", (e) => {
            if (e.target.getAttribute("data-dir") === "desc") {
                sortT(json, e.target.id, "desc");
                e.target.setAttribute("data-dir", "asc");
            } else {
                sortT(json, e.target.id, "asc");
                e.target.setAttribute("data-dir", "desc");
            }
        });
    });
});

// the titles should tell you what its doing
function createRow(data) {
    let row = document.createElement("tr");
    let objKeys = Object.keys(data);
    objKeys.map((key) => {
        let elem = document.createElement("td");
        elem.setAttribute("data", key);
        elem.innerText = data[key];
        row.appendChild(elem);
        // make the selection possible
        row.addEventListener("click", () => {
            document.getElementById("selected").innerText = row.querySelector('td[data="name"]').innerText;
            document.getElementById("selected").setAttribute("data", row.innerText);
            document.getElementById("confirm").style.display = "block";
        })
        row.querySelector('td[data="name"]').style.fontWeight = "bold";
    })
    return row;
}

function getTableCont(data) {
    data.map((obj) => {
        const row = createRow(obj);
        tableContent.appendChild(row);
    })
}

function sortT(data, param, direction = "asc") {
    tableContent.innerText = "";
    let sortedData =
        direction === "asc"
            ? [...data].sort((a, b) => {
                if (a[param] === null) {
                    return 1;
                }
                if (b[param] === null) {
                    return -1;
                }
                if (a[param] < b[param]) {
                    return -1;
                }
                if (a[param] > b[param]) {
                    return 1;
                }
                return 0;
            })
            : [...data].sort((a, b) => {
                if (a[param] === null) {
                    return 1;
                }
                if (b[param] === null) {
                    return -1;
                }
                if (b[param] < a[param]) {
                    return -1;
                }
                if (b[param] > a[param]) {
                    return 1;
                }
                return 0;
            });
    return getTableCont(sortedData);
}

function genTableHeaders(json) {
    let cols = Object.keys(json[0]);
    let thead = document.createElement("thead");
    let tr = document.createElement("tr");

    // Name each column
    cols.forEach((item) => {
        // name the headers
        let title;
        switch (item) {
            case "name":
                title = Parts[partSelected];
                break
            case "price":
                title = "Price:";
                break
            case "core_count":
                title = "Cores:";
                break
            case "core_clock":
                title = "Clock Speed:";
                break
            case "boost_clock":
                title = "Boost Clock speed:";
                break
            case "tdp":
                title = "Thermal Design Power:";
                break
            case "graphics":
                title = "Graphics:";
                break
            case "smt":
                title = "Simultaneous Multi-threading:";
                break
            default:
                title = "Broken Title XXXXXXXX";

        }

        let th = document.createElement("th");
        let button = document.createElement("button");

        button.innerText = title;
        button.setAttribute("class", "table-head");
        button.setAttribute("id", item)
        th.append(button)
        tr.appendChild(th);
    });
    thead.appendChild(tr);
    tableHead.append(thead);
}

// save selection
function confirmSelect() {
    localStorage.setItem(partSelected, document.getElementById("selected").getAttribute("data"));
    console.log(localStorage)
    location.href = "../buid.php";
}