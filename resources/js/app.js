import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const notificationsContainer = document.getElementById('notifications');

    // Substitueix `userId` amb l'ID de l'usuari autenticat
    window.Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
            // Crea un nou element per la notificació
            const notificationElement = document.createElement('div');
            notificationElement.classList.add('notification');
            notificationElement.textContent = notification.message;

            // Afegeix la notificació al contenidor
            notificationsContainer.prepend(notificationElement);
        });
});
