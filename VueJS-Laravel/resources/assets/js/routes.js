let routes = [
	{
		path: '/',
		component: require('./components/App.vue'),
		children: [
			{
				path: '',
				component: require('./components/Home.vue')
			}
		]
	}
]

module.exports = routes