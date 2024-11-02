// Funktion zum Einstellen und Speichern der Sprache in localStorage
function setLanguage(language) {
    // Sprache in localStorage speichern
    localStorage.setItem('language', language);
    applyTranslations(language); // Anwenden der Sprache auf der Seite
}

// Funktion zum Laden der gespeicherten Sprache
function loadLanguage() {
    const savedLanguage = localStorage.getItem('language') || 'de'; // Standard auf Deutsch
    applyTranslations(savedLanguage); // Anwenden der gespeicherten Sprache
}

// Füge die Sprache in die URL-Parameter hinzu, wenn der Nutzer navigiert
function navigateWithLanguage(url) {
    const language = localStorage.getItem('language') || 'de'; // Hole die gespeicherte Sprache
    const newUrl = new URL(url, window.location.origin);
    newUrl.searchParams.set('lang', language); // Füge die Sprache als URL-Parameter hinzu
    window.location.href = newUrl; // Navigiere zur neuen URL
}

// Initialisiere die Sprache beim Laden des Dokuments
document.addEventListener("DOMContentLoaded", loadLanguage);
