<!DOCTYPE html>
<html lang="pt-BR">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento PayPal</title>
</head>
<body>
<div id="stars"></div>
  <div id="stars2"></div>
  <div id="stars3"></div>

<!-- Container onde o botão de pagamento será renderizado -->
<div id="paypal-button-container"></div>

<script src="https://www.paypal.com/sdk/js?client-id=AU3H6yQNXXNQtstFyyg473j8B7WkgSb2x5x0MEvkB6OshANUBSFvwpY_xLkq3INglxqhO9xzbPsLPWKL"></script>
<script>
    paypal
        .Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '10.00' // Substitua pelo valor que você deseja cobrar
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Verifique se o pagamento foi aprovado com sucesso
                    if (details.status === 'COMPLETED') {
                        // O pagamento foi confirmado com sucesso
                        alert('Pagamento aprovado: ' + details.payer.name.given_name);
                    } else {
                        // O pagamento não foi aprovado
                        alert('Pagamento não aprovado.');
                    }
                });
            }
        })
        .render('#paypal-button-container');
</script>
</body>
</html>