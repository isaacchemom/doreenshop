<template>

<!-- DELETE ITEMS  MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove Staff ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="alert alert-warning">Are you sure you want to delete item?</h6>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" @click="removeStaff">Delete</button>
            </div>
        </div>
    </div>
</div>
<!---end of delete modal-->
    <!-- Radio buttons -->
    <div style="background-color:white;" class="mt-4 ml-4 mr-4">
    
        <hr />
    
        <div class="modal fade" id="taskmodal" tabindex="-1" role="dialogx" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centred modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
    
                        <h5 class="modal-title" id="taskModalLabel">{{ !editMode ? 'Add Staff.' : 'Update Staff' }}</h5>
    
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
                        <form class="row g-3 m-auto"  @submit.prevent="!editMode ? saveStaff() : editStaff()">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" v-model="staff.name" required pattern="[A-Za-z\s]+">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact</label>
                                <input type="text" class="form-control" v-model="staff.contact" required>
                            </div>
                            <div class="col-md-6">
                            <label class="form-label">Staff Category</label>
                            <select v-model="staff.category" class="form-control" required>
                                <option value="" disabled>Select </option>
                                <option value="Teaching Staff" >TEACHING STAFF</option>
                                <option value="Non Teaching Staff">NONE TEACHING STAFF</option>
                                
                             </select>
                             </div>
    
                            <div class="col-md-6">
                                <label class="form-label">Tittle|Designation</label>
                                <input type="text" class="form-control" v-model="staff.designation" required>
                            </div>
    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">
                                    {{ !editMode ? 'Add Staff' : 'Update' }}</button>
                            </div>
                        </form>
                    </div>
    
                </div>
            </div>
        </div>
    
    </div>
    <hr>
    
    <h4 class="text-center">STAFF</h4>
    <button @click="newStaff" class="btn btn-primary">ADD NEW </button>
    <table class="table table-stripped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NAME</th>
                <th scope="col">CONTACT</th>
                <th scope="col">CATEGORY</th>
    
                <th scope="col">DESIGNATION|TITLE</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(mystaff, index) in staffs" v-bind:key="index">
                <td>{{ index+1}}</td>
                <td>{{ mystaff.name }}</td>
                <td>{{ mystaff.contact }}</td>
                <td>{{ mystaff.category }}</td>
                <td>{{ mystaff.designation}}</td>
    
                <!---<td> <input type="text" v-model="myform.name[task.id]"></td> -->
                <!--<td>
    
                   <input @onblur="update(task,$event.target.value)" >-
                  <a href="#" @click.prevent="updates(task)"><i class="fa fa-edit"></i></a>
                </td>-->
                <td> <a href="#" @click.prevent="updateStaff(mystaff)"><i class="fa fa-edit"></i>edit</a>
                 <a href="#" @click.prevent="deleteStaff(mystaff)"><i class="fa fa-trash text-danger  ml-4"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
    </template>
    
    <script>
    //import axios from 'axios';
    //import mynav from '../nav.vue'
    export default {
        // components: {
        // mynav,
    
        // },
        data() {
            return {
                staff: {
                    name: '',
                    contact: '',
                    category: '',
                    designation: ''
                },
                showAlert: false,
                form: null,
                edit: false,
                editMode: false,
                staffs: []
    
            }
    
        },
    
        mounted() {
            this.getStaff()
        },
        methods: {
            newStaff() {
    
                this.editMode = false
                this.staff = {
                    name: '',
                    contact: '',
                    category: '',
                    designation: ''
    
                }
    
                $("#taskmodal").modal("show");
            },
    
            updateStaff(mystaff) {
                //console.log(supplier);
    
                this.editMode = true;
                $("#taskmodal").modal("show");
                this.staff = mystaff;
    
            },
            deleteStaff(mystaff) {
                //console.log(supplier);
    
                this.editMode = true;
                $("#deleteModal").modal("show");
                this.staff.id = mystaff.id;
    
            },
    
            saveStaff() {
    
                this.$emitter.emit('changeLoaderStatus', true)
                // var data = new FormData(formOnes);
                axios.post("http://127.0.0.1:8000/api/addStaff", this.staff).then(response => {
                    this.$toast.success(`Staff added successfully`, {
                        position: "top",
                        dismissible: false
                    })
                    $("#taskmodal").modal("hide");
    
                    //alert("EXCEL FILE saved successfully");
                    this.$emitter.emit('changeLoaderStatus', false)
                    this.getStaff()
                }).catch(error => {
    
                    //alert("Error in uploading,check your file type and try gain!");
    
                    if (error.response && error.response.status === 500) {
                        this.importErrors = error.response.data.error;
                        this.showAlert = true;
    
                        setTimeout(() => {
                            this.showAlert = false;
                        }, 20000);
                        //console.log('Errors:', this.errors);
                    } else {
                        //console.error('Unknown errors:', error);
                        // alert('check file again')
                        this.$toast.error(`Error! try again or conduct system admin!`, {
                                position: "top"
    
                            }
    
                        )
                    }
                    this.$emitter.emit('changeLoaderStatus', false)
    
                });
            },

            editStaff() {

this.$emitter.emit('changeLoaderStatus', true)
axios.patch("http://127.0.0.1:8000/api/editStaff/" + this.staff.id, this.staff).then(() => {

    this.$toast.success(`Staff updated successfully`,

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

// function to fetch categories for selection on item selcetion form
getCategories() {
this.$emitter.emit('changeLoaderStatus', true)
axios.get("http://127.0.0.1:8000/api/getCategories").then(response => {
    this.mycategories = response.data.data;

    this.$emitter.emit('changeLoaderStatus', false)
})

},
    
            getStaff() {
                this.$emitter.emit('changeLoaderStatus', true)
                axios.get("http://127.0.0.1:8000/api/getStaff").then(response => {
                    this.staffs = response.data.data;
    
                    this.$emitter.emit('changeLoaderStatus', false)
                })
    
            },
            removeStaff() {
            this.$emitter.emit('changeLoaderStatus', true)
            // var data = new FormData(formOnes);
            axios.post("http://127.0.0.1:8000/api/deleteStaff/" + this.staff.id).then(response => {

                $("#deleteModal").modal("hide");
                this.staffs = this.staffs.filter((staff) => staff.id !== this.staff.id);

                this.$toast.success(`Staff Removed successfully`, {
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
    
        },
    
    }
    </script>
    
    
    