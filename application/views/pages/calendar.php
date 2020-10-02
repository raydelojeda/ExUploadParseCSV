

<div class="row">
    <div class="col-md-12 col-lg-3 border-right">
        <div class="card-body">
            <h4 class="card-title">Drag and Drop Your Event</h4>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="calendar-events" class="mt-3">
                        <div class="calendar-events" data-class="bg-info"><i class="fa fa-circle mb-3 text-info"></i> My Event One</div>
                        <div class="calendar-events" data-class="bg-success"><i class="fa fa-circle mb-3 text-success"></i> My Event Two</div>
                        <div class="calendar-events" data-class="bg-danger"><i class="fa fa-circle mb-3 text-danger"></i> My Event Three</div>
                        <div class="calendar-events" data-class="bg-warning"><i class="fa fa-circle mb-3 text-warning"></i> My Event Four</div>
                    </div>
                    <!-- checkbox -->
                    <div class="checkbox mb-3">
                        <input id="drop-remove" type="checkbox">
                        <label for="drop-remove">
                            Remove after drop
                        </label>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#add-new-event" class="btn btn-danger btn-block waves-effect waves-light">
                        <i class="ti-plus"></i> Add New Event
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-9">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
    </div>
</div>

<div class="modal none-border" id="my-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Event</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade none-border" id="add-new-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add</strong> a category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Category Name</label>
                            <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name" />
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Choose Category Color</label>
                            <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                <option value="success">Success</option>
                                <option value="danger">Danger</option>
                                <option value="info">Info</option>
                                <option value="primary">Primary</option>
                                <option value="warning">Warning</option>
                                <option value="inverse">Inverse</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>