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

                    <h5 class="modal-title" id="taskModalLabel">{{ !editMode ? 'Sale Product: '  : 'Update sales' }}</h5> &nbsp;
                    <h6 class="text-red bg-violet  mt-2"> {{ gender}}- {{ category }} - {{ color}} - {{ name }}- {{ size }} </h6>
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
                    <form class="row g-3 m-auto" ref="form" @submit.prevent="!editMode ? saveSales() : editSales()">

                        <!--
                            <div class="col-md-6">
                                <label class="form-label">ITEM</label>
                                <select v-model="item.staffID" class="form-control" required>
                                    <option value="" disabled>Select staff</option>

                                    <option v-for="item in myitems" :value="item.id" :key="item.id">{{item.name }}</option>
                                   </select>
                                   </div>

                            <div class="col-md-6">
                                <label class="form-label">ITEM</label>
                                <select v-model="item.staffID" class="form-control" required>
                                    <option value="" disabled>Select staff</option>

                                    <option v-for="item in myitems" :value="item.id" :key="item.id">{{item.name }}</option>
                                </select>
                            </div> -->

                        <div class="col-md-6">
                            <label class="form-label">Select Product</label>
                            <v-select :options="myProducts" label="name" v-model="selectedProduct" required placeholder="search here...">

                                <template #option="option">
                                    <span> {{ option.name }}</span> For <span> {{ option.gender }}</span> - <span> {{ option.category }}</span>

                                </template>
                            </v-select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Selling Price</label>
                            <input type="text" class="form-control" v-model="sale.unitprice" required @input="calculateTotal">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Quantity</label>
                            <input type="text" class="form-control" v-model="sale.quantity" required @input="calculateTotal">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-warning">Total Price</label>
                            <input type="text" class="form-control" disabled v-model="sale.totalprice">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-default">Product decription</label>
                            <input type="text bg" class="form-control" disabled v-model="mydescription">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-default">Remaining Stock</label>
                            <input type="text" class="form-control" disabled v-model="itemQuantity">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                {{ !editMode ? 'Save ' : 'Update' }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
<hr>

<div class="ml-4">
    <!--
    <button class="btn btn-primary" @click="newItem">NEW SALE </button>

    <h6 class="text-center">List of sales</h6>

    <table class="display nowrap" style="width:100%" id="myDataTablex">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NAME</th>

                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total price</th>
                <th scope="col">Date </th>
                <th scope="col">Option</th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="(mysale, index) in DailySales" v-bind:key="index">
                <td scope="row">{{ index+1}}</td>

                <td>{{ mysale.products.name }}</td>

                <td>{{ mysale.unit_price }}</td>
                <td>{{ mysale.quantity }}</td>
                <td>{{ mysale.total_price }}</td>
                <td>{{ mysale.created_at }}</td>

                <td>
                    <a href="#" @click.prevent="updateItem(mysale)"><i class="fa fa-edit"></i></a>

                </td>
            </tr>
        </tbody>
    </table>
-->
</div>

<vue-good-table :columns="columns" :rows="DailySales" :fixed-header="false" :line-numbers="true" max-height="500px" :search-options="{
      enabled: true,
      placeholder: 'Search',
    }" :pagination-options="{
      enabled: true,
      perPage: 15,
    }" styleClass="vgt-table striped condensed  table-hover">
</vue-good-table>

   

<div>
    <!----<easy-data-table  class="table table-bordered table-striped" id='empTable'

    :headers="headers"
    :items="items"
  /> -->


 


</div>
</template>

  <script>


//DataTable.use(pdfmake)
//DataTable.use(pdfFonts)




export default {
   

    data() {

        return {
            sale: {

                quantity: 0,
                unitprice: 0,
                totalprice: 0,
                productId: ''

            },
            selectedProduct: null,
            selectedStaff: null,
            itemQuantity: '',
            mydescription: '',

            showAlert: false,
            //  form: null,
            // edit: false,
            editMode: false,
            myProducts: [],
            mycategories: [],
            DailySales: [],
            staffs: [],
            departments: [],
            searchText: "",

            columns: [{
                    label: 'Product Name',
                    field: 'products.name',
                },
                {
                    label: 'Type|Fashion',
                    field: 'products.type',

                },
                {
                    label: 'Color',
                    field: 'products.color',

                },
                {
                    label: 'Category',
                    field: 'products.category',

                },
                {
                    label: 'Gender',
                    field: 'products.gender',

                },
                {
                    label: 'size',
                    field: 'products.size',

                },
                {
                    label: 'quantity',
                    field: 'quantity',

                },
                {
                    label: 'Unit price',
                    field: 'unit_price',

                },
                {
                    label: 'Total amount',
                    field: 'total_price',

                },

                {
                    label: 'Sold On',
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
            headers: [{
                    text: "Name",
                    value: "name"
                },
                {
                    text: "Height (cm)",
                    value: "height",
                    sortable: true
                },
                {
                    text: "Weight (kg)",
                    value: "weight",
                    sortable: true
                },
                {
                    text: "Age",
                    value: "age",
                    sortable: true
                }
            ],
            items: [{
                    "name": "Curry",
                    "height": 178,
                    "weight": 77,
                    "age": 20
                },
                {
                    "name": "James",
                    "height": 180,
                    "weight": 75,
                    "age": 21
                },
                {
                    "name": "Jordan",
                    "height": 181,
                    "weight": 73,
                    "age": 22
                }
            ],


       


      

        }

        

    },
    watch: {
        'selectedProduct': function (newVal, oldVal) {
            // The 'newVal' parameter will contain the newly selected item
            if (newVal) {
                this.onProductSelected(newVal);
            }
        },

        'selectedStaff': function (newVal, oldVal) {
            // The 'newVal' parameter will contain the newly selected item
            if (newVal) {
                this.onStaffSelected(newVal);
            }
        },
    },

    mounted() {
        this.getProducts();

//this.getCategories();
this.getSales();
      
        // this.getStaff()
           
        /*this.loadScript('https://code.jquery.com/jquery-3.7.0.js', () => {
            this.loadScript('https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js', () => {
                this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js', () => {
                    this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js', () => {
                        this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js', () => {
                            this.loadScript('https://adminlte.io/themes/v3/plugins/datatables-buttons/js/dataTables.buttons.min.js', () => {
                                this.loadScript('https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.print.min.js', () => {
                                    this.loadScript('https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js', () => {
                                        //this.loadScript('https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.flash.min.js', () => {
                                           // this.loadScript('https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.colVis.min.js', () => {
                                                this.loadScript('https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js', () => {
                                                    this.loadStylesheet('https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css', () => {
                                                        this.loadStylesheet('https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css', () => {

                                                            // Initialize DataTables in the mounted lifecycle hook
                                                            $(document).ready(function () {
                                                                $('#example').DataTable({
                                                                    dom: 'Bfrtip',
                                                                    buttons: [
                                                                        'copy', 'csv', 'excel', 'pdf', 'print'
                                                                    ]
                                                                });
                                                            });


                                                            
                                                        });
                                                    });
                                                });
                                            //});
                                       // });
                                    });
                                });
                            });
                        });
                    });
                });
            });
        });
*/


      
    },

    methods: {
/*
        loadScript(src, callback) {
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = src;
            script.onload = callback;
            document.head.appendChild(script);
        },
        loadStylesheet(href, callback) {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.type = 'text/css';
            link.href = href;
            link.onload = callback;
            document.head.appendChild(link);
        },
*/
        calculateTotal() {
            this.sale.totalprice = this.sale.unitprice * this.sale.quantity
        },

        onProductSelected(selectedItem) {
            this.productID = selectedItem.id
            this.itemQuantity = selectedItem.remain_quantity;
            this.mydescription = selectedItem.description;

            this.category = selectedItem.category;

            this.name = selectedItem.name;
            this.gender = selectedItem.gender;
            this.color = selectedItem.color;
            this.size = selectedItem.size;

            //console.log('Item selected: ' + selectedItem.name);
        },
        onStaffSelected(selectedStaff) {
            this.staffID = selectedStaff.id
            //console.log('Item selected: ' + selectedItem.name);
        },

        newItem() {

            this.editMode = false
            this.sale = {
                quantity: '',
                unitprice: '',
                totalprice: '',
                productId: ''

            }

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

        saveSales() {

            let formData = new FormData();

            formData.append('quantity', this.sale.quantity);
            formData.append('unitprice', this.sale.unitprice);
            formData.append('totalprice', this.sale.totalprice);
            formData.append('productId', this.productID);

            //IF FUNCTION TO CHECK IF QUANTITY IS OUT STOCK
            if (this.sale.quantity > this.itemQuantity) {

                //toast.info("I'm an info toast!");

                this.$toast.error(`Please you have entered quantity greater than the remaining stock!`, {
                    position: "top"

                })

            } else {

                this.$emitter.emit('changeLoaderStatus', true)

                // var data = new FormData(formOnes);
                axios.post("http://127.0.0.1:8000/api/saleProduct", formData).then(response => {

                    this.$toast.success(`Product sale Saved successfully`, {
                        position: "top",
                        dismissible: false
                    })
                    $("#taskmodal").modal("hide");

                    this.$emitter.emit('changeLoaderStatus', false);
                    this.getItems();
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
            }
        },

        getSales() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getDailySales").then(response => {
                this.DailySales = response.data.data;

                this.$emitter.emit('changeLoaderStatus', false)
            })

        },

        getProducts() {
            //  this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getProducts").then(response => {
                this.myProducts = response.data.data;

                //  this.$emitter.emit('changeLoaderStatus', false)
            })

        },

        editSales() {

            this.$emitter.emit('changeLoaderStatus', true)
            axios.patch("http://127.0.0.1:8000/api/updateSales/" + this.sale.id, this.sale).then(() => {

                this.$toast.success(`Saved successfully`,

                    {
                        position: "top",
                        dismissible: false

                    }

                )
                $("#taskmodal").modal("hide");

                this.$emitter.emit('changeLoaderStatus', false)

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

        removeSales() {
            this.$emitter.emit('changeLoaderStatus', true)
            // var data = new FormData(formOnes);
            axios.post("http://127.0.0.1:8000/api/deleteSales/" + this.sale.id).then(response => {

                $("#deleteModal").modal("hide");
                this.sales = this.sales.filter((sale) => sale.id !== this.sale.id);

                this.$toast.success(`Deleted successfully`, {
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

        getStaff() {
            // this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getStaff").then(response => {
                this.staffs = response.data.data;

                // this.$emitter.emit('changeLoaderStatus', false)
            })

        },

    },

}
</script>
<style scoped>
@import 'datatables.net-bs5';
</style>