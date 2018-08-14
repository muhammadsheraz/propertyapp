@extends ('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                   Notifications <small class="text-muted">{{ __('strings.backend.all_notifications')}}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <table id="district-data-table" class="table table-striped table-bordered">
                    
                        <thead>
                            <tr>
                                <th>{{ __('strings.backend.notifications')}}</th>
                                <th>{{ __('strings.frontend.performed_at')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($notifications_all as $notification)
                            <tr>
                                <?php 
                                    $action = '';
                                    
                                    if (!empty($notification->data['action'])) {
                                        $action = get_notification_message($notification);
                                    }
                                ?>
                                <td>
                                    <?php echo $action; ?>
                                    <br>
                                    <?php 
                                        // if ($notification->id == '9400807c-da3e-44fd-a2de-105bc9df5012') {
                                            // echo '<pre>'; print_r($notification->data); echo '</pre>'; 

                                        // }
                                    ?>
                                </td>
                                <td><?php echo strftime('%d %b, %Y %H:%M', strtotime($notification->created_at)); ?></td>
                            </tr>
                        @endforeach 
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@endsection



@push('after-scripts')
    
    <script type="text/javascript">
        $(document).ready(function() {
          $('#district-data-table').DataTable({
              "aaSorting": []
          });
        } );
    </script>

@endpush