<template>
<div>
	<h5>Users list</h5>
	<a class="waves-effect waves-light btn"><i class="material-icons left">add</i>Add</a>
	<a class="waves-effect waves-light btn"><i class="material-icons left">refresh</i>Refresh</a><hr/>
	<div class="responsive-table">
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>AGE</th>
					<th>EMAIL</th>
					<th class="action-cell">Update</th>
					<th class="action-cell">Delete</th>
				</tr>
			</thead>
			<tbody>

				<tr v-if="status === 'loading'">
					<td colspan="6" class="center-align">
						<div class="progress container">
      				<div class="indeterminate"></div>
  					</div>
  				</td>
  			</tr>

  			<tr v-else-if="status === 'error'">
  				<td colspan="6" class="center-align">
  					An error occured
  				</td>
  			</tr>

  			<tr v-else-if="users.length < 1">
  				<td colspan="6" class="center-align">
  					No users
  				</td>
  			</tr>

  			<tr v-else v-for="user in users">
  				<td>{{ user.id }}</td>
  				<td>{{ user.name }}</td>
  				<td>{{ user.age }}</td>
  				<td>{{ user.email }}</td>
  				<td class="action-cell"><a class="btn blue">Update</a></td>
  				<td class="action-cell"><a class="btn red">Delete</a></td>
  			</tr>

			</tbody>
		</table>
	</div>
</div>
</template>

<style>
.action-cell {
		width: 100px;
}
</style>

<script>
module.exports = {
		
		created: function(){
				console.log(this)
				this.getUsers()
		},

		data: function(){
				return {
						status: 'success'
				}
		},

		methods: {
				getUsers: function(){
						let vm = this
						this.status = 'loading'
						console.log(axios.get('api/v1/user')
									.then((response)=>{
										  console.log(response)
										  this.status = 'success'
										  this.users = response.data.data
									})
									.catch((error)=>{
										  console.log(error)
										  this.status = 'error'
									}))
				}
		},

		computed: {
				users: {
						get: function(){
								return this.$parent.$data.users
						},
						set: function(users){
								this.$parent.$data.users = users
						}
				}
		}
}
</script>