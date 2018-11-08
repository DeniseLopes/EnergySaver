<div class="c-carousel ">
	<div class="c-carousel__arrow c-carousel__arrow--left"></div>
	<div class="c-carousel__arrow c-carousel__arrow--right"></div>
	<ul class="c-carousel__slides">
		<li><img src="//unsplash.it/300/450?random=1"/></li>
		<li><img src="//unsplash.it/300/450?random=2"/></li>
		<li><img src="//unsplash.it/300/450?random=3"/></li>
		<li><img src="//unsplash.it/300/450?random=4"/></li>
		<li><img src="//unsplash.it/300/450?random=5"/></li>
		<li><img src="//unsplash.it/300/450?random=6"/></li>
	</ul>
</div>
<style type="text/css">
.slide_content{
	margin-top: 20px;
	background: red;
}
img {
	display: block;
	height: 400px;
	margin-right: 10px;
}

.c-carousel {
	width: 100%;
	position: relative;
	margin-top: 30px;
}
.c-carousel__arrow {
	width: 30px;
	height: 30px;
	position: absolute;
	top: 50%;
	z-index: 1;
	-webkit-transform: translateY(-50%) rotate(45deg);
	transform: translateY(-50%) rotate(45deg);
	background-color: white;
}
.c-carousel__arrow--left {
	left: 15px;
}
.c-carousel__arrow--right {
	right: 15px;
}
.c-carousel__slides {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	margin: 0;
	padding: 0;
	list-style: none;
	will-change: transform;
}
</style>
<script type="text/javascript">
	'use strict';

	var carousel = function carousel(options) {

		var _carousel = {

			paused: false,

			stopped: false,

			options: {
				speed: 3000,
				acceleration: 5,
				reverse: false,
				selector: '.c-carousel',
				slidesSelector: '.c-carousel__slides',
				leftArrowSelector: '.c-carousel__arrow--left',
				rightArrowSelector: '.c-carousel__arrow--right'
			},

			init: function init() {
				var options = arguments.length <= 0 || arguments[0] === undefined ? {} : arguments[0];

            // Copy options to this.options
            for (var prop in options) {
            	if (!options.hasOwnProperty(prop)) break;
            	this.options[prop] = options[prop];
            }

            // Cache nodes
            var carousel = document.querySelector(options.selector || this.options.selector);
            var slides = this._slides = carousel.querySelector(this.options.slidesSelector);
            this._leftArrow = carousel.querySelector(this.options.leftArrowSelector);
            this._rightArrow = carousel.querySelector(this.options.rightArrowSelector);

            // Multiply speed value by the number of slides
            this.options.speed = this.options.speed * slides.children.length;

            // Set slides container width
            this.width = slides.offsetWidth;

            // Repeat elements
            slides.innerHTML = slides.innerHTML + slides.innerHTML + slides.innerHTML;

            this._registerEvents();
            this._animate();
        },
        _registerEvents: function _registerEvents() {
        	var _this = this;

        	var speed = this.options.speed;
        	var reverse = this.options.reverse;

        	this._rightArrow.addEventListener('mouseover', function () {
        		_this.options.speed = speed / _this.options.acceleration;
        		_this.options.reverse = false;
        	});
        	this._rightArrow.addEventListener('mouseleave', function () {
        		_this.options.speed = speed;
        		_this.options.reverse = reverse;
        	});
        	this._leftArrow.addEventListener('mouseover', function () {
        		_this.options.speed = speed / _this.options.acceleration;
        		_this.options.reverse = true;
        	});
        	this._leftArrow.addEventListener('mouseleave', function () {
        		_this.options.speed = speed;
        		_this.options.reverse = reverse;
        	});

            // Pause when cursor is over carousel
            this._slides.addEventListener('mouseover', this.pause.bind(this));
            this._slides.addEventListener('mouseleave', this.start.bind(this));

            // Pause when cursor is over carousel
            window.addEventListener('resize', function () {
            	_this.width = _this._slides.offsetWidth;
            });
        },
        pause: function pause() {
        	this.paused = true;
        },
        start: function start() {
        	this.paused = false;
        },
        stop: function stop() {
        	this.stopped = true;
        },
        _animate: function _animate() {
        	var _this2 = this;

        	var slides = this._slides;
        	var oneThird = slides.lastElementChild.getBoundingClientRect().right / 3;
        	var framesCount = 0;
        	var step = 0;
        	var posX = 0;

        	var animate = function animate() {
        		if (!_this2.paused) {

        			framesCount = _this2.options.speed * 60 / 1000;
        			step = oneThird / framesCount;

        			posX += _this2.options.reverse ? step : -step;

        			slides.style.transform = 'translateX(' + posX + 'px)';

        			if (_this2.options.reverse) {
        				if (posX >= _this2.width - oneThird) {
        					posX = _this2.width - oneThird * 2;
        				}
        			} else {
        				if (Math.abs(posX) >= oneThird * 2) {
        					posX = -oneThird;
        				}
        			}
        		}
        		!_this2.stopped && requestAnimationFrame(animate);
        	};
        	animate();
        }
    };

    _carousel.init(options);

    return _carousel;
};

window.onload = function () {
	return carousel({
		selector: '.c-carousel'
	});
};
</script>