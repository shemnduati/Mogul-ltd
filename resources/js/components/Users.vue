<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">User Management</h3>

                        <div class="card-tools">
                            <button class="btn btn-sm btn-primary">
                                Add User
                            </button>
                        </div>
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
                                <input  type="text" name="location"
                                       placeholder="Enter Town"
                                       class="form-control">
                               
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" v-if="!this.editMode">
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
export default {
    name: "User Management",
    data() {
        return {};
    },
    methods: {
        newModal() {
                this.editMode = false;
                $('#addnew').modal('show');
            },
    },
};
</script>

<style scoped></style>
