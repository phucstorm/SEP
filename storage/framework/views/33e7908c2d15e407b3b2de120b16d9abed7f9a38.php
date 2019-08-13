<?php $__env->startPush('head'); ?>
<!-- Scripts -->
<script src="<?php echo e(asset('js/host-poll.js')); ?>" defer></script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="create-poll mt-3 mb-3">
        <button class="btn btn-success create-poll-btn" data-toggle="modal" data-target="#createPollModal">Create Poll</button>
    </div>
    <div class="row">
        <div class="poll-section col-md-6 col-sm-12">
            <span>Poll list</span>
            <div class="poll-container">
                <?php $__currentLoopData = $event->polls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="poll-item p-3 d-flex justify-content-between">
                        <div class="poll-detail">
                            <div style="opacity: 0.5">
                                <?php if($poll->mul_choice == 1): ?>    
                                    Multiple Choice
                                <?php else: ?>
                                    Single Choice
                                <?php endif; ?>
                            </div>
                            <div class="poll-votes">Votes: <?php echo e($poll->total_votes); ?></div>
                            <div class="poll-content"><?php echo e($poll->poll_question_content); ?></div>
                        </div>
                        <div class="poll-action">
                            <form action="/admin/event/poll/status/<?php echo e($poll->id); ?>"  enctype="multipart/form-data" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <input type="text" name="event_id" value="<?php echo e($event->id); ?>" hidden>                  

                                <?php if($poll->status==1): ?>
                                    <input type="text" name="status-poll" value="stop" hidden>
                                    <button class="stop-poll-btn">
                                        <i class="fa fa-stop-circle" aria-hidden="true"></i>
                                    </button>
                                <?php else: ?>
                                    <input type="text" name="status-poll" value="play" hidden>
                                    <button class="play-poll-btn">
                                        <i class="fa fa-play-circle" aria-hidden="true"></i>
                                    </button>
                                <?php endif; ?>
                            </form>
                            <button type="button" class="btn edit-poll-btn" data-toggle="modal" data-target="#edit<?php echo e($poll->id); ?>">
                                <i class="fa fa-edit"></i>
                            </button>
                            
                            <button class="delete-poll-btn" data-id="<?php echo e($poll->id); ?>" data-toggle="modal" data-target="#deletePol<?php echo e($poll->id); ?>">
                                <i class="fa fa-trash"></i>
                            </button>
                            
                        </div>
                    </div>  
                        <!-- Modal For Delete Poll -->
                    <div class="modal fade" id="deletePol<?php echo e($poll->id); ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="/admin/event/poll/delete/<?php echo e($poll->id); ?>"  enctype="multipart/form-data" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <div class="modal-header">
                                    <h4 class="modal-title" id="delete_title"><?php echo e($poll->poll_question_content); ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure that you want to delete this poll?

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-danger" id="del">Delete</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Poll Modal -->
                        
                    <div class="modal fade" id="edit<?php echo e($poll->id); ?>" role="dialog">
                        <div class="modal-dialog">
                        
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="/admin/event/poll/edit/<?php echo e($poll->id); ?>" enctype="multipart/form-data" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <div class="modal-header">
                            <h4 class="modal-title">Edit Poll</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            </div>
                            <div class="modal-body">

                                    <div class="row">
                                        <div class="col-10 offset-1">     
                                            <input type="text" name="event_id" value="<?php echo e($event->id); ?>" hidden>                  
                                            <div class="form-group row">
                                                <label for="poll_question_content">Poll Content</label>
                                                <input id="poll_question_content" 
                                                    type="text" 
                                                    class="form-control <?php if ($errors->has('poll_question_content')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('poll_question_content'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" 
                                                    name="poll_question_content" 
                                                    value="<?php echo e($poll->poll_question_content); ?>" 
                                                    autocomplete="poll_question_content" 
                                                    autofocus required>
                                                <?php if ($errors->has('poll_question_content')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('poll_question_content'); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                            </div>
                                            <div class="form-group row poll-answer">
                                                <label for="poll_answer">Poll Answer</label>
                                                <?php $__currentLoopData = $poll->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="w-100 position-relative">
                                                <input id="poll_answer" 
                                                    type="text" 
                                                    class="form-control <?php if ($errors->has('poll_answer')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('poll_answer'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?> mt-2" 
                                                    name="poll_answer[<?php echo e($answer->id); ?>]" 
                                                    value="<?php echo e($answer -> poll_answer_content); ?>" 
                                                    autocomplete="poll_answer" 
                                                    autofocus required>
                                                    <button type="button" class="delete-poll-answer-btn"><i class="fa fa-trash"></i></button>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="form-group-row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <button type="button" class="btn plus-new-answer w-100 add-answer">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> Answer
                                                </button>
                                            </div>
                                            <div class="form-group row">
                                                <label class='multiple-answer-label' for='multiple-answer'>
                                                    <input id='multiple-answer' name='mul_choice' type='checkbox' value='1' 
                                                    <?php if($poll->mul_choice==1): ?>
                                                    checked
                                                    <?php endif; ?>
                                                    />
                                                    Multiple Answers
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button class="btn btn-success">Save</button>
                                </div>
                                </form>
                            </div>
                        
                        </div>
                    </div>      
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="poll-section col-md-6 col-sm-12">
            <span>Live</span>
            <div class="poll-container poll-live position-relative p-3">
                
                <?php if($event->polls()->where('status',1)->first()!=[]): ?>
                    <?php $runningPoll = $event->polls()->where('status',1)->first(); ?>
                    <span class="position-absolute voted-person"><?php echo e($runningPoll->total_votes); ?> <i class="fa fa-user" aria-hidden="true"></i></span>

                    <div class="poll-title p-2">
                    <?php echo e($runningPoll->poll_question_content); ?>

                    </div>
                    <div class="poll-result">
                    <?php
                        $sum=0;
                        foreach($runningPoll->answers as $answer){
                            $sum+=$answer->votes;
                        }
                    ?>
                    <?php if($sum!=0): ?>
                        <?php $__currentLoopData = $runningPoll->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="poll-result-item p-1">
                                <div class="poll-result-answer">
                                    <?php echo e($answer->poll_answer_content); ?> <span class="votes">(<?php echo e($answer->votes); ?>)</span>
                                </div>
                                <div class="result-bar">
                                    <span class="poll-result-bar" data-width="<?php echo e(($answer->votes/$sum)*90); ?>%"></span>
                                    <span class="percent"><?php echo e(round(($answer->votes/$sum)*100)); ?>%</span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <?php $__currentLoopData = $runningPoll->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="poll-result-item p-1">
                                <div class="poll-result-answer">
                                    <?php echo e($answer->poll_answer_content); ?> <span class="votes">(0)</span>
                                </div>
                                <!-- width là (số lượt vote answers/tổng số vote) * 100 -->
                                <div class="result-bar">
                                    <span class="poll-result-bar" data-width="0%"></span>
                                    <span class="percent">0%</span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    </div>
                <?php else: ?>
                    There is no poll running now!
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Create Poll Modal -->
         
    <div class="modal fade" id="createPollModal" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <form action="/admin/event/poll/create" class="create-poll-form" enctype="multipart/form-data" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                <h4 class="modal-title">Create Poll</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-10 offset-1">     
                                <input type="text" name="event_id" value="<?php echo e($event->id); ?>" hidden>                  
                                <div class="form-group row">
                                    <label for="poll_question_content">Poll Content</label>
                                    <input id="poll_question_content" 
                                        type="text" 
                                        class="form-control <?php if ($errors->has('poll_question_content')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('poll_question_content'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" 
                                        name="poll_question_content" 
                                        value="<?php echo e(old('poll_question_content')); ?>" 
                                        autocomplete="poll_question_content" 
                                        autofocus required>
                                    <?php if ($errors->has('poll_question_content')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('poll_question_content'); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                                <div class="form-group row poll-answer">
                                    <label for="poll_answer">Poll Answer</label>
                                    <input id="poll_answer" 
                                        type="text" 
                                        class="form-control <?php if ($errors->has('poll_answer')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('poll_answer'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" 
                                        name="poll_answer[]" 
                                        value="<?php echo e(old('poll_answer')); ?>" 
                                        autocomplete="poll_answer" 
                                        autofocus required>
                                    <?php if ($errors->has('poll_answer')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('poll_answer'); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                    <input id="poll_answer" 
                                        type="text" 
                                        class="form-control <?php if ($errors->has('poll_answer')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('poll_answer'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?> mt-2" 
                                        name="poll_answer[]" 
                                        value="<?php echo e(old('poll_answer')); ?>" 
                                        autocomplete="poll_answer" 
                                        autofocus required>
                                    <?php if ($errors->has('poll_answer')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('poll_answer'); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                                <div class="form-group-row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <button type="button" class="btn plus-answer w-100 add-answer">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Answer
                                    </button>
                                </div>
                                <div class="form-group row">
                                    <label class='multiple-answer-label' for='multiple-answer'>
                                        <input id='multiple-answer' name='mul_choice' type='checkbox' value='1' />
                                        Multiple Answers
                                    </label>
                                </div>
                            </div>
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="create-poll" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>   
        </div>
    </div>    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.eventlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEP\Lavarel\SEP\resources\views/event/hostpoll.blade.php ENDPATH**/ ?>