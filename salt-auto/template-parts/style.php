<style media="screen">

html {
    min-height: 100vh;
    <?php if (is_admin_bar_showing()): ?>
    	min-height: calc( 100vh - 32px );
    <?php endif; ?>
    display: flex;
    flex-direction: column;
}

body {
    display: flex;
    flex-direction: column;
    flex: 1;
}

div#page {
    flex: 1;
}

#quick-qualify-banner, #quick-qualify-banner img {
    width: 100%;
}

.car-badges .car-badge {
	margin: 5px auto;
}
.car-badges img {
  max-width: 100%;
}

.car-report img {
  width: 110px;
  height: auto;
}


h4.car-title {
  font-weight: bold;
}

.car-monthly, .car-price {
  font-size: 1.25rem;
  font-weight: bold;
}

.car-price {
  color: green;
}

span.car-retail.reduced {
    text-decoration: line-through;
		color: #990000;
}


.car-placeholder-img {
  width: 100%;
  position: relative;
}

.owl-theme .owl-nav {
  margin-top: 0;
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.owl-theme .owl-nav button[class*=owl-] {
  background-color: rgb(0, 0, 0);
  margin: 0;
  padding: 0.25em 0.8em!important;
  border-radius: 0;
	opacity: 0.66;
	transition: 0.3s ease opacity;
}
.owl-theme:hover .owl-nav button[class*=owl-] {
	opacity: 1;
}
.owl-theme .owl-nav button[class*=owl-] {
	color: white;
}

a.zoom-car-images {
  position: absolute;
  top: 0;
  left: 15px;
  padding: 5px;
  z-index: 20;
  color: white;
  background-color: rgba(0, 0, 0, 0.6);
  border-bottom-right-radius: 5px;
	opacity: 0;
	transition: 0.3s ease opacity;
}
.car-images-wrapper:hover a.zoom-car-images {
	opacity: 1;
}

.quick-qualify-badge-link img {
    max-width: 100%;
    margin: auto;
    display: block;
}

@media only screen and (min-width: 1440px) {
	.wrapper {
		max-width: 1440px;
		margin: auto;
	}
	.wrapper-fluid {
		max-width: initial;
	}
}




</style>
