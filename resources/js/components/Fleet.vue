<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Fleet Management</h3>

                        <div class="card-tools">
                            <button class="btn btn-sm btn-primary"  @click="newModal">
                                Add Vehicle
                            </button>
                        </div>
                    </div>
                
                <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#id</th>
                                <th>Vehicle Reg</th>
                                <th>Vehicle Type</th>
                                <th>Vehicle Model</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="veh in vehicles" :key="veh.id">
                                <td>{{veh.id}}</td>
                                 <td>{{veh.registration}}</td>
                                 <td>{{veh.type}}</td>
                                 <td>{{veh.model}}</td>
                                 <td>{{veh.location}}</td>
                                  <td>{{veh.status}}</td>
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
                        <h5 class="modal-title" v-if="!this.editMode">Add A vehicle</h5>
                        <h5 class="modal-title" v-if="this.editMode">Edit vehicle </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Vehicle Type</label>
                                <input v-model="form.type" type="text" name="type"
                                       placeholder="Enter Vehicle Type"
                                       class="form-control">
                               
                            </div>
                            <div class="form-group">
                                <label>Vehicle Model</label>
                                <input v-model="form.model" type="text" name="model"
                                       placeholder="Enter Vehicle Model"
                                       class="form-control">
                               
                            </div>
                            <div class="form-group">
                                <label>Vehicle Registration Number</label>
                                <input v-model="form.registration " type="text" name="registration"
                                       placeholder="Enter Vehicle Registration Number"
                                       class="form-control">
                               
                            </div>
                            <div class="form-group">
                                        <label for="level">Vehicle Station Location</label>
                                        <select v-model="form.status" class="form-control" name="status" id="status">
                                            <option selected value="">--Select Stauts--</option>
                                            <option value="1">Mombasa</option>
                                            <option value="2">Nairobi</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                        <label for="level">Vehicle Status</label>
                                        <select v-model="form.location" class="form-control" name="location" id="location">
                                            <option selected value="">--Select Station--</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Loading</option>
                                            <option value="3">Dispatched</option>
                                            <option value="4">Delivered</option>
                                        </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" v-if="!this.editMode" @click="addVehicle">
                                Create
                            </button>
                            <button type="button" class="btn btn-success"  v-if="this.editMode">
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
    name: "Fleet Management",
    data() {
        return {
            vehicles:'',
            stauts:'',
            location:'',
            editMode: "",
            form: new Form({
                id: "",
                type: "",
                model: "",
                registration: "",
                status: "",
                location:"",
            }),
        };
    },
    methods: {
        updateVehicle() {
            this.form
                .put("api/vehicle/" + this.form.id)
                .then(() => {
                    $("#addnew").modal("hide");
                })
                .catch(() => {});
        },
        editVehicle(veh) {
            this.editMode = true;
            $("#addnew").modal("show");
            this.form.fill(veh);
        },
        getVehicle() {
            axios
                .get("/api/vehicle")
                .then(({ data }) => [(this.vehicles = data['parent'])]);
        },
        getLocation() {
            axios
                .get("/api/location")
                .then(({ data }) => [(this.location = data)]);
        },
        getStatus() {
            axios
                .get("/api/vehicleStatus")
                .then(({ data }) => [(this.status = data)]);
        },
        addVehicle() {
            this.form
                .post("api/vehicle")
                .then(() => {
                    $("#addnew").modal("hide");
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
        newModal() {
            this.editMode = false;
            $("#addnew").modal("show");
        },
    },
    created() {
        this.getStatus();
        this.getLocation();
        this.getVehicle();
    },
};
</script>

<style scoped></style>
