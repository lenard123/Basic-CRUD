<!Doctype html>
<html>
    <head>
        <title>Basic CRUD with Laravel and VueJs</title>
        <script src="js/app.js"></script>
        <script src="js/vee-validate.min.js"></script>
        <script src="js/vue.js"></script>
        <script src="js/axios.min.js"></script>

        <link rel="stylesheet" href="css/app.css">
        <style type="text/css">
             .main-content{
                padding: 100px 10px;
                margin-bottom: 0px; 
             }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" id="nav">
            <div class="container-fluid">

                <div class="navbar-header">
                    
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <a class="navbar-brand" href="#">Basic CRUD with Laravel+Vuejs</a>

                </div>

                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="app">
            <div class="container">
                <div class="main-content">
                    <div style="max-width: 800px">
                        <form id="itemsForm" v-on:submit.prevent="submit()">
                            <div v-bind:class="{'has-error':errors.has('name')}">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" v-validate="'required'" v-model="newItems.name">
                                <span v-show="errors.has('name')"  class="text-danger">@{{ errors.first('name') }}</span>
                            </div><br/>
                            <div v-bind:class="{'has-error':errors.has('email')}">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" v-validate="'required'" v-model="newItems.email">
                                <span v-show="errors.has('email')"  class="text-danger">@{{ errors.first('email') }}</span>
                            </div> <br>
                            <div>
                                <button v-if="!onEdit" class="btn btn-primary">Add New</button>
                                <button v-if="onEdit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-default" id="resets">Reset</button>
                                <button v-if="onEdit" v-on:click="createNew" class="btn btn-info">Create New</button>
                            </div><br/>                                          
                        </form><br/>
                        <div class="panel panel-info" style="max-width: 800px">
                            <div class="panel-heading">Item Details</div>
                            <div class="panel-body" style="padding: 0px">
                                <div class="table-responsive">
                                     <table class="table table-stripped">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr v-for="row in rows">
                                            <td>@{{ row.id }}</td>
                                            <td>@{{ row.name }}</td>
                                            <td>@{{ row.email }}</td>
                                            <td>
                                                <button class="btn btn-primary" v-on:click="edit(row.id, row.name, row.email)">Edit</button>
                                                <button class="btn btn-danger" v-on:click="deleteItem(row.id)">Delete</button>
                                            </td>
                                        </tr>
                                    </table>    
                                </div>
                            </div>
                        </div>                               
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        Vue.use(VeeValidate);
        var app = new Vue({
            el: '#app',
            data: {
                message: 'Hello world!',
                onEdit:false,
                newItems:{
                    name: '',
                    email:''
                },
                selectedAll:false,
                rows:[],
                id:''
            },

            created(){
                this.getRows();
            }, 

            methods:{
                submit: function(){
                    var vm = this;
                    this.$validator.validateAll().then(
                        function(isValid){
                            if(!isValid) return;

                            if(vm.onEdit){
                                var url = './item/'+ vm.id;
                                var params = 'name='+escape(vm.newItems.name)+'&email='+escape(vm.newItems.email);

                                axios.put(url, params).then(
                                    function(response){
                                        vm.createNew();
                                        vm.getRows();
                                    }
                                ).catch(
                                    function(error){
                                        console.log(error);
                                    }
                                )
                            }else{
                                var url = './item';
                                var params = 'name='+escape(vm.newItems.name)+'&email='+escape(vm.newItems.email);

                                axios.post(url, params).then(
                                    function(response){
                                        vm.createNew();
                                        vm.getRows();
                                    }
                                ).catch(
                                    function(error){
                                        console.log(error);
                                    }
                                )
                            }

                        }
                    )
                },

                deleteItem: function(id){
                    var vm = this;
                    var url = './item/'+ id;
                    axios.delete(url).then(
                        function(response){
                            vm.createNew();
                            vm.getRows();
                        }
                    ).catch(
                        function(error){
                            console.log(error);
                        }
                    )
                }, 

                edit: function(id, name, email){
                    this.id = id;
                    this.onEdit = true;
                    this.newItems = {
                        name: name,
                        email: email
                    }
                },

                createNew: function(){
                    this.onEdit = false;
                },

                getRows: function(){
                    var vm = this;
                    axios.get('./item').then(
                        function(result){
                            vm.rows = result.data;
                        }
                    )
                }
            }
        })
    </script> 
</html>