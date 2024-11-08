document.addEventListener("DOMContentLoaded", function () {
    // Holt die aktuelle URL ohne Parameter (alles nach `?` wird entfernt)
    const currentPath = window.location.pathname.split("/").pop();

    // Definiert die Zuordnung von Seiten zu IDs der Navigationselemente
    const pageMapping = {
        "index.html": "nav-home",
        "about.html": "nav-about",
        "services.html": "nav-services",
        "contact.html": "nav-contact"
    };

    // Überprüft, ob die aktuelle Seite im Mapping vorhanden ist
    if (pageMapping[currentPath]) {
        // Fügt die Klasse 'active' zum Navigations-Link der aktuellen Seite hinzu
        document.getElementById(pageMapping[currentPath]).classList.add("active");
    }
});