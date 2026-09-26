// 4U.IA.BR Elite Standard - Common Utilities
document.addEventListener('DOMContentLoaded', () => {
    // Year synchronization
    document.querySelectorAll('.current-year').forEach(el => {
        el.textContent = new Date().getFullYear();
    });

    // Handle close buttons (compliant with MV3)
    document.querySelectorAll('.btn-close-window').forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault();
            window.close();
        });
    });
});
