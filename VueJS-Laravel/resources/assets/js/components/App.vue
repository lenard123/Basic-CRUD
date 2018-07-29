<template>
<div>
	<nav>
		<div class="nav-wrapper">
			<a href="#" class="left brand-logo">Basic CRUD</a>
			<ul id="nav-mobile" class="right hide-on-small">
				<li><a href="#">Made By L</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<router-view></router-view>
	</div>
</div>
</template>

<script>
module.exports = {
		data: function(){
				return {
					users: []
				}
		}
}
</script>