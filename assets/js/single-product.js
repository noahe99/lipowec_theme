document.addEventListener("DOMContentLoaded", function () {
    const checkbox = document.getElementById("gastro-info-switch");

    function setCookie(name, value, days) {
        const expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=/';
    }

    function setActiveRow(type) {
        if (type === "gastro") {
            checkbox.checked = true;
            setCookie("kundentyp", "gastro", 30);
        } else {
            checkbox.checked = false;
            setCookie("kundentyp", "privat", 30);
        }
    }

    
    const savedState = localStorage.getItem("gastroSwitch");

    // Initial state
    setActiveRow(savedState === "gastro" ? "gastro" : "privat");

    // On toggle
    checkbox.addEventListener("change", function () {
        if (checkbox.checked) {
            localStorage.setItem("gastroSwitch", "gastro");
            setActiveRow("gastro");
        } else {
            localStorage.setItem("gastroSwitch", "privat");
            setActiveRow("privat");
        }

        location.reload();
    });
});
