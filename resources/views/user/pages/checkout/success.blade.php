<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Thank you 🤝</title>
		<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}" />
		<link rel="stylesheet" href="{{asset('frontend/css/thankyou.css')}}" />
    </head>
    <body>
		<main  class="main_website_wrapper" style="background-image: url('{{URL::to('frontend/images/page_bg.png')}}')">
			<div class="js-container container" style="top:0px !important;">
				<div class="thankyou_wrapper">
					<div class="theme_ws_box thankyou">
						<div class="checkmark-circle">
							<div class="background"></div>
							<div class="checkmark draw"></div>
						</div>
						<h1>Congratulations! You'r order is success</h1>
						<div class="content">
							<p>Your order number Tracking no <strong>{{ $order->order_tracking_id }}</strong>.</p>
							<p>Total Amount: <strong>{{ $order->total }}</strong>৳</p>
						</div>
						<a href="{{ url('/') }}" class="btn_style">Continue Shopping</a>
					</div>
				</div>
			</div>
		</main>
        <script>
            const Confettiful = function(el) {
                this.el = el;
                this.containerEl = null;
                this.confettiFrequency = 3;
                this.confettiColors = ['#EF2964', '#00C09D', '#2D87B0', '#48485E', '#EFFF1D'];
                this.confettiAnimations = ['slow', 'medium', 'fast'];
                this._setupElements();
                this._renderConfetti();
            };
            Confettiful.prototype._setupElements = function() {
                const containerEl = document.createElement('div');
                const elPosition = this.el.style.position;
                if (elPosition !== 'relative' || elPosition !== 'absolute') {
                    this.el.style.position = 'relative';
                }
                containerEl.classList.add('confetti-container');
                this.el.appendChild(containerEl);
                this.containerEl = containerEl;
            };
            Confettiful.prototype._renderConfetti = function() {
                this.confettiInterval = setInterval(() => {
                    const confettiEl = document.createElement('div');
                    const confettiSize = (Math.floor(Math.random() * 3) + 7) + 'px';
                    const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors.length)];
                    const confettiLeft = (Math.floor(Math.random() * this.el.offsetWidth)) + 'px';
                    const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this.confettiAnimations.length)];
                    confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
                    confettiEl.style.left = confettiLeft;
                    confettiEl.style.width = confettiSize;
                    confettiEl.style.height = confettiSize;
                    confettiEl.style.backgroundColor = confettiBackground;
                    confettiEl.removeTimeout = setTimeout(function() {
                        confettiEl.parentNode.removeChild(confettiEl);
                    }, 3000);
                    this.containerEl.appendChild(confettiEl);
                }, 25);
            };
            window.confettiful = new Confettiful(document.querySelector('.js-container'));
        </script>
    </body>
</html>