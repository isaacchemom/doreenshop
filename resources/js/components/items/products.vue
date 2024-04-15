<template>
<!-- DELETE ITEMS  MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DELETE ITEM?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="alert alert-warning">Are you sure you want to delete item?</h6>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" @click="removeItem">Delete</button>
            </div>
        </div>
    </div>
</div>
<!---end of delete modal-->
<div style="background-color:white;" class="mt-4 ml-4 mr-4">

    <hr />

    <div class="modal fade" id="taskmodal" tabindex="-1" role="dialogx" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centred modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="taskModalLabel">{{ !editMode ? 'Add Item.' : 'Update items' }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div v-if="showAlert">
                    <div v-if="importErrors">
                        <p class="alert alert-danger col-md-8"> {{ importErrors }} </p>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="row g-3 m-auto" ref="form" @submit.prevent="!editMode ? saveProduct() : editProduct()">
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" v-model="product.name" required  placeholder="e.g shirt, trouser ">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Type|Fashion </label>
                            <input type="text" class="form-control" v-model="product.type" required placeholder="e.g jeans">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Color</label>
                            <input type="text" class="form-control" v-model="product.color" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Size</label>
                            <input type="text" class="form-control" v-model="product.size" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select v-model="product.gender" class="form-control" required>
                                <option value="" disabled>Select </option>
                                <option value="Female" >Female</option>
                                <option value="Male">Male</option>
                                <option value="Universal" >universal</option>  
                             </select>
                             </div>
                             <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select v-model="product.category" class="form-control" required>
                                <option value="" disabled>Select </option>
                                <option value="Female" >Adult</option>
                                <option value="Male">Children</option>
                                 
                             </select>
                             </div>

                       
                        <div class="col-md-6">
                            <label class="form-label">Quantity Receceived</label>
                            <input type="text" class="form-control" v-model="product.quantity" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unit Price</label>
                            <input type="text" class="form-control" v-model="product.unitprice" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Total Price</label>
                            <input type="text" class="form-control" v-model="product.totalprice" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">DESCRIPTION</label>
                            <textarea type="text" class="form-control" v-model="product.description"></textarea>
                        </div>
                        <hr/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                {{ !editMode ? 'save Product' : 'Update product' }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
<hr>

<div class="ml-4">
    <button class="btn btn-primary" @click="newItem">ADD NEW </button>

    <h6 class="text-center">List of items in Stock</h6>
    <!--
    <table class="table table-stripped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NAME</th>
                <th scope="col">ITEM NUMBER</th>
                <th scope="col">CATEGORY</th>
                <th scope="col">SUPPLIER NAME</th>
                <th scope="col">QUANTITY</th>
                <th scope="col">REM QUANTITY</th>
                <th scope="col">PRICE</th>
                <th scope="col">DEPARTMENT</th>
                <th scope="col">Option</th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="(myproduct, index) in products" v-bind:key="index">
                <td scope="row">{{ index+1}}</td>
                <td scope="row">{{ myproduct.name }}</td>
                <td>{{ myproduct.color }}</td>
                
                <td>{{ myproduct.price }}</td>
                
                <td>  <input @onblur="update(task,$event.target.value)" 
                  <a href="#" @click.prevent="updates(task)"><i class="fa fa-edit"></i></a>  </td>
                <td> <a href="#" @click.prevent="updateItem(myproduct)"><i class="fa fa-edit"></i></a>
                    <a href="#" @click.prevent="deleteItem(myproduct)"><i class="fa fa-trash text-danger  ml-4"></i></a>
                </td>
            </tr>
        </tbody>
    </table> -->
</div>

<vue-good-table :columns="columns" :rows="products" :fixed-header="false" :line-numbers="true" max-height="500px"
 :search-options="{
  enabled: true,
  placeholder: 'Search',
}" :pagination-options="{
  enabled: true,
  perPage: 15,
}" styleClass="vgt-table striped condensed  table-hover">
</vue-good-table>

</template>

<script>
export default {
    // components: {

    data() {
        return {
            product: {
                name: '',
                color: '',
                size:'',
                gender:'',
                quantity: '',
                unitprice: '',
                totalprice:'',
                description: '',
                category:'',
                type:''

                

            },
            showAlert: false,
            //  form: null,
            // edit: false,
            editMode: false,
            products: [],
            mycategories: [],
            suppliers: [],
            departments:[],


            columns: [{
                    label: 'Item Name',
                    field: 'name',
                },
                {
                    label: 'Type|Fashion',
                    field: 'type',

                },
                {
                    label: 'Color',
                    field: 'color',

                },
                {
                    label: 'Category',
                    field: 'category',

                },
                {
                    label: 'Gender',
                    field: 'gender',

                },
                {
                    label: 'size',
                    field: 'size',

                },
                {
                    label: 'quantity',
                    field: 'quantity',

                },
                {
                    label: 'Selling price',
                    field: 'unit_price',

                },
                {
                    label: 'Description',
                    field: 'description',

                },

                {
                    label: 'Date created',
                    field: 'created_at',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd\'T\'HH:mm:ss.SSSSSSxxx',
                    dateOutputFormat: 'MMM do yyyy, HH:mm:ss',
                },

                {
                    label: 'Actions',
                    field: 'actions'
                }

            ],

        }

    },

    mounted() {

        this.getProducts();
      //  this.getsuppliers();

       // this.getCategories();
       // this.getDepartments()
    },

    methods: {
        newItem() {

            this.editMode = false
           this.product={
                name: '',
                color: '',
                size:'',
                gender:'',
                quantity: '',
                unitprice: '',
                totalprice:'',
                description: '',
                type:''
                

            },

            $("#taskmodal").modal("show");
        },

        updateItem(myitem) {
            //console.log(supplier);
            //this.item = ''
           // console.log(this.item)
            this.editMode = true;
            $("#taskmodal").modal("show");
            this.item = myitem;

            // alert('hi boy')

        },

        deleteItem(myitem) {
            //this.editMode = false

            this.item.id = myitem.id;
            $("#deleteModal").modal("show");
        },

        saveProduct() {

            this.$emitter.emit('changeLoaderStatus', true)
            // var data = new FormData(formOnes);
            axios.post("http://127.0.0.1:8000/api/addProduct", this.product).then(response => {

                this.$toast.success(`Item Saved successfully`, {
                    position: "top",
                    dismissible: false
                })
                $("#taskmodal").modal("hide");

                this.$emitter.emit('changeLoaderStatus', false);
                this.getProducts();
                //this.items.push(this.item);

            }).catch(error => {

                if (error.response && error.response.status === 500) {
                    this.importErrors = error.response.data.error;
                    this.showAlert = true;

                    setTimeout(() => {
                        this.showAlert = false;
                    }, 5000);
                    //console.log('Errors:', this.errors);
                } else {

                    this.$toast.error(`serverError! try again!`, {
                            position: "top"

                        }

                    )
                }
                this.$emitter.emit('changeLoaderStatus', false)

            });
        },

      

        getProducts() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getProducts").then(response => {
                this.products = response.data.data;

                this.$emitter.emit('changeLoaderStatus', false)
            })

        },

        editProduct() {

            this.$emitter.emit('changeLoaderStatus', true)
            axios.patch("http://127.0.0.1:8000/api/updateProduct/" + this.product.id, this.product).then(() => {

                this.$toast.success(`Product updated successfully`,

                    {
                        position: "top",
                        dismissible: false

                    }

                )
                $("#taskmodal").modal("hide");

                this.$emitter.emit('changeLoaderStatus', false)
                this.getItems();

            }).finally(() => {
                $("#taskModal").modal("hide")
            }).catch(error => {

                if (error.response && error.response.status === 500) {
                    this.importErrors = error.response.data.error;
                    this.showAlert = true;

                    setTimeout(() => {
                        this.showAlert = false;
                    }, 5000);
                    //console.log('Errors:', this.errors);
                } else {
                    //console.error('Unknown errors:', error);
                    // alert('check file again')
                    this.$toast.error(`Error! try again!`, {
                            position: "top"

                        }

                    )
                }
                this.$emitter.emit('changeLoaderStatus', false)

            }).finally(() => {
                $("#taskModal").modal("hide");
            });
        },

        // function to fetch categories for selection on item selcetion form
        getCategories() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getCategories").then(response => {
                this.mycategories = response.data.data;

                this.$emitter.emit('changeLoaderStatus', false)
            })

        },

        removeProduct() {
            this.$emitter.emit('changeLoaderStatus', true)
            // var data = new FormData(formOnes);
            axios.post("http://127.0.0.1:8000/api/deleteProduct/" + this.product.id).then(response => {

                $("#deleteModal").modal("hide");
                this.products = this.products.filter((product) => product.id !== this.product.id);

                this.$toast.success(`Product Deleted successfully`, {
                    position: "top",
                    dismissible: false
                })

                this.$emitter.emit('changeLoaderStatus', false)
            }).catch(error => {

                //alert("Error in uploading,check your file type and try gain!");

                if (error.response && error.response.status === 500) {

                    this.$toast.error(`SOMETHING WENT WRONG! CONTACT ADMIN FOR HELP!`, {
                            position: "top"

                        }

                    )
                } else {

                    this.$toast.error(`serverError! try again!`, {
                            position: "top"

                        }

                    )
                }
                this.$emitter.emit('changeLoaderStatus', false)

            });

        },
        getsuppliers() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getsuppliers").then(response => {
                this.suppliers = response.data.data;

                this.$emitter.emit('changeLoaderStatus', false)
            })

        }

    },

}
</script>

<style></style>
