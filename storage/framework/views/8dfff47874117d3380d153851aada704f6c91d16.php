<?php $__env->startSection('content'); ?>
<main class="main">
    <div class="container">
        <div class="create-event-btn">
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createEvent"
                id="create-event-btn">
                Create Event
            </button>
        </div>
        <?php echo e(csrf_field()); ?>

        <?php if($event == '[]' && isset($_GET['search'])): ?>
        <div>No result found</div>
        <?php else: ?>
        <?php $__currentLoopData = $event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- dẫn link event-container vô room -->
        <div class="event-container">
            <div class="event-short-info" onclick="window.location.href='/admin/event/<?php echo e($value->event_code); ?>'">
                <div class="event-icon"></div>
                <div class="event-namecode">
                    <div class="event-name"><i class="fa fa-calendar" aria-hidden="true"></i><a
                            href="/admin/event/<?php echo e($value->event_code); ?>"><?php echo e($value->event_name); ?></a></div>
                    <div class="event-code">#<?php echo e($value->event_code); ?></div>
                </div>
                <div class="event-description mb-2"><?php echo e($value->event_description); ?></div>
                <div class="event-startend-date">
                <span class="time"><?php echo e(Carbon\Carbon::parse($value->start_date)->format('h:iA')); ?></span>
                        <span class="date"><?php echo e(Carbon\Carbon::parse($value->start_date)->format('dM Y')); ?></span> - 
                        <span class="time"><?php echo e(Carbon\Carbon::parse($value->end_date)->format('h:iA')); ?></span>
                        <span class="date"><?php echo e(Carbon\Carbon::parse($value->end_date)->format('dM Y')); ?></span>
                </div>
            </div>
            <div class="event-action">
                <i class="fa fa-ellipsis-v toggle-action"></i>
                <ul class="event-action-mobile">
                    <li><button class="btn btn-outline-info qr-btn-mobile" data-toggle="modal" data-target=".qrcode">QR
                            Code</button></li>
                    <li><button class="btn btn-outline-success" data-id="<?php echo e($value->id); ?>"
                            data-code="<?php echo e($value->event_code); ?>" 
                            data-name="<?php echo e($value->event_name); ?>"
                            data-description="<?php echo e($value->event_description); ?>" 
                            data-link="<?php echo e($value->event_link); ?>"
                            data-mod="<?php echo e($value->setting_moderation); ?>" 
                            data-start="<?php echo e(Carbon\Carbon::parse($value->start_date)->format('Y-m-d\TH:i')); ?>"
                            data-end="<?php echo e(Carbon\Carbon::parse($value->end_date)->format('Y-m-d\TH:i')); ?>" 
                            data-join="<?php echo e($value->setting_join); ?>"
                            data-question="<?php echo e($value->setting_question); ?>" 
                            data-reply="<?php echo e($value->setting_reply); ?>"
                            data-anonymous="<?php echo e($value->setting_anonymous); ?>" 
                            data-toggle="modal"
                            data-target="#edit">Edit</button></li>
                    <li><button type="button" class="btn btn-outline-danger" 
                        data-id="<?php echo e($value->id); ?>"
                        data-name="<?php echo e($value->event_name); ?>"
                            data-toggle="modal" data-target="#delete">Delete</button></li>
                </ul>
                <button type="button" class="btn btn-outline-success desktop-btn" data-id="<?php echo e($value->id); ?>"
                    data-code="<?php echo e($value->event_code); ?>" 
                    data-name="<?php echo e($value->event_name); ?>"
                    data-description="<?php echo e($value->event_description); ?>" 
                    data-link="<?php echo e($value->event_link); ?>"
                    data-mod="<?php echo e($value->setting_moderation); ?>" 
                    data-start="<?php echo e(Carbon\Carbon::parse($value->start_date)->format('Y-m-d\TH:i')); ?>"
                    data-end="<?php echo e(Carbon\Carbon::parse($value->end_date)->format('Y-m-d\TH:i')); ?>"  
                    data-join="<?php echo e($value->setting_join); ?>"
                    data-question="<?php echo e($value->setting_question); ?>" 
                    data-reply="<?php echo e($value->setting_reply); ?>"
                    data-anonymous="<?php echo e($value->setting_anonymous); ?>" 
                    data-toggle="modal" 
                    data-target="#edit"><i
                        class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn btn-outline-info qr-btn desktop-btn" data-toggle="modal"
                    data-target=".qrcode">
                    <i class="fa fa-qrcode"></i></button>
                <div class="modal fade qrcode" tabindex="-1" role="dialog" aria-labelledby="qrcode" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="title"><?php echo e($value->event_name); ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="margin:0 auto;">
                                <?php echo QrCode::size(600)->generate($value->event_link);; ?>

                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-danger desktop-btn" data-id="<?php echo e($value->id); ?>"  data-name="<?php echo e($value->event_name); ?>"
                    data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>

    <!-- Modal For Creat Event -->
    <div class="modal fade" id="createEvent" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" method="post" class="submit-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Create Event</h5>

                </div>
                <div class="modal-body">
                    
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Event Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="event_name" name="event_name"
                                    placeholder="Event Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="event_description" name="event_description"
                                    placeholder="Write desciption here" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date" required
                                value="<?php echo e(Carbon\Carbon::parse(date('Y-m-d'))->format('Y-m-d\TH:i')); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">End Date</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date" required
                                value="<?php echo e(Carbon\Carbon::parse(date('Y-m-d', time() + 86400))->format('Y-m-d\TH:i')); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12  text-center date-error-message">
                                <span class="text-danger">The end time must be greater than the start time</span>
                            </div>
                            <div class="col-sm-12  text-center data-error-message">
                                <span class="text-danger">Please check the information you have entered, we do not accept incorrect dates</span>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="add-new-event-btn">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal For Edit Event -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form role="form" method="post" id="edit_form" class="submit-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Edit Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Event Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="en" name="en" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Event Code</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ec" name="ec" required>
                            </div>
                            <div class="col-sm-12  text-center event-code-error-message">
                                <span class="text-danger">This event code have already existed. Please enter another one.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ds" name="ds" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="sd" name="sd" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">End Date</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="ed" name="ed" required>
                            </div>
                        </div>
                        <div class="form-event-optional">
                            <label class="col-form-label">Options: </label>
                            <div class="form-group row">
                                <label for="ji" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="ji" name="ji">
                                    <span> Join</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="qt" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="qt" name="qt">
                                    <span> Ask</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="rl" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="rl" name="rl">
                                    <span> Reply</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="rl" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="md" name="md">
                                    <span> Moderation</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="rl" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="an" name="an">
                                    <span> Anonymous</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Link</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="li" name="li" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12  text-center date-error-message">
                                <span class="text-danger">The end time must be greater than the start time</span>
                            </div>
                            <div class="col-sm-12  text-center data-error-message">
                                <span class="text-danger">Please check the information you have entered, we do not accept incorrect dates</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" id="update">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal For Delete Event -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="delete_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure that you want to delete this event?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="del">Delete</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEP\Lavarel\SEP\resources\views/event/index.blade.php ENDPATH**/ ?>