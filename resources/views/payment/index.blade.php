<html>
  <head>
    <title>Buy cool new product</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <button id="checkout-button">Checkout</button>
  </body>
</html>


<script type="text/javascript">
      // Create an instance of the Stripe object with your publishable API key
      var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');
      var checkoutButton = document.getElementById('checkout-button');

      checkoutButton.addEventListener('click', function() {
        // Create a new Checkout Session using the server-side endpoint you
        // created in step 3.
        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });
        //var url = 'http://localhost:8000/create-checkout-session';
        fetch('/create-checkout-session', {
          method: 'POST',
          headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then(function(response) {
          return response.json();
        })
        .then(function(session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function(result) {
          // If `redirectToCheckout` fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using `error.message`.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function(error) {
          console.error('Error:', error);
        });
      });
    </script>
  </body>
</html>