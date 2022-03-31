<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title"> Station Location</h3>

                        <div class="card-tools">
                            <button class="btn btn-sm btn-primary" @click="newModal">
                                Add Location
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#id</th>
                                <th>Location</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="loc in location.data" :key="loc.id">
                                <td>{{loc.id}}</td>
                                 <td>{{loc.location}}</td>
                                 <td>
                                    <i class="btn-sm btn-info">Edit</i>
                                 </td>
                                 <td>
                                    <i class="btn-sm btn-danger" >Delete</i>
                                 </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="addnewLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!this.editMode">Add Station Location</h5>
                        <h5 class="modal-title" v-if="this.editMode">Edit Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Station Location Town</label>
                                <input v-model="form.location" type="text" name="location"
                                       placeholder="Enter Town"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('location') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" @click="addLocation" v-if="!this.editMode">
                                Create
                            </button>
                            <button type="button" class="btn btn-success" @click="updateLocation" v-if="this.editMode">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform';
export default {
    name: "station Location",
    data() {
        return {
            location: '',
                editMode: '',
                form: new Form({
                    id: '',
                    location: '',
                })
        };
    },
    methods: {
         updateLocation() {
                this.form.put('api/location/' + this.form.id)
                    .then(() => {
                        $('#addnew').modal('hide');
                        
                    })
                    .catch(() => {

                    })
            },
            editLocation(loc) {
                this.editMode = true;
                $('#addnew').modal('show');
                this.form.fill(loc);
            },
            getLocation() {
                axios.get("/api/location").then(({data}) => ([this.location = data]));
            },
            addLocation() {
                this.form.post('api/location')
                    .then(() => {
                        $('#addnew').modal('hide');
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        
                    })
            },
            newModal() {
                this.editMode = false;
                $('#addnew').modal('show');
            },
        },
        created() {
            this.getLocation();
            
        }
    }
</script>

<style scoped></style>
