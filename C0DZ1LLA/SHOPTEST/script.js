// Stripe public key
const stripe = Stripe('pk_test_51HbuSeAhcFh6mP3tk2aJDLoRC5AFkwFLk4ZxtVCGYQAzjAWsFGTwRetAaH2sWcSLJsUvKTjQPLllpwJWDfxaIbwr00Kf3IXT3B');

document.getElementById('checkout-button').addEventListener('click', () => {
    fetch('https://c0dz1lla.glitch.me/create-checkout-session', {  // Update this line
        method: 'POST',
    })
    .then(response => response.json())
    .then(session => {
        return stripe.redirectToCheckout({ sessionId: session.id });
    })
    .then(result => {
        if (result.error) {
            alert(result.error.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
