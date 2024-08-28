<div class="row">
    <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
             {!! Form::open(['url' => '/users', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
             <?php for ($i = 0; $i <= 3; $i++) { ?>
                 <div class="col-lg-12" id="filter_{{$i}}" @if($i!=0) style="display:none;" @endif>
                     <div class="row">
                         <div class="col-lg-2 form-group">
                             {!! Form::label('search_in', 'Search In') !!}
                             <select name="search_in[{{$i}}]" id = "search_in_{{$i}}" data-id="{{$i}}" class="search_in js-states form-control select2-selection__rendered" tabindex="-1" style="width: 100%">
                                 <option value="full_name" @if(isset($inputValue) && ($inputValue['search_in'][$i]=='full_name' )){{{ "selected" }}} @endif>Full Name</option>
                                 <option value="user_name" @if(isset($inputValue) && ($inputValue['search_in'][$i]=='user_name' )){{{ "selected" }}} @endif>User Name</option>
                                 <option value="email_id" @if(isset($inputValue) && ($inputValue['search_in'][$i]=='email_id' )){{{ "selected" }}} @endif>Email Address</option>
                                 <option value="phone_number" @if(isset($inputValue) && ($inputValue['search_in'][$i]=='phone_number' )){{{ "selected" }}} @endif>Phone No</option>
                                
                                {{--
                                 <option value="block_flag" @if(isset($inputValue) && ($inputValue['search_in'][$i]=='block_flag' )){{{ "selected" }}} @endif>Is Verified </option>
                                 --}} 
                                {{-- <option value="is_verified" @if(isset($inputValue) && ($inputValue['search_in'][$i] == 'is_verified')){{{ "selected" }}} @endif >Is Active </option> --}}
                                 <option value="created_datetime" @if(isset($inputValue) && ($inputValue['search_in'][$i]=='created_datetime' )){{{ "selected" }}} @endif>Registered On</option>
                                 
                             </select>
                         </div>

                         <div class="col-lg-2 form-group form-group-search">
                             {!! Form::label('search_type', 'Search Type') !!}
                             <select name="search_type[{{$i}}]" id="search_type_{{$i}}" class="js-states form-control select2-selection__rendered" tabindex="-1" style="width: 100%">
                                 <option value="contains" @if(isset($inputValue) && ($searchType[$i]=='contains' )){{{ "selected" }}} @endif>Contains</option>
                                 <option value="begins_with" @if(isset($inputValue) && ($searchType[$i]=='begins_with' )){{{ "selected" }}} @endif>Begins With</option>
                                 <option value="ends_with" @if(isset($inputValue) && ($searchType[$i]=='ends_with' )){{{ "selected" }}} @endif>Ends With</option>
                                 <option value="exact_match" @if(isset($inputValue) && ($searchType[$i]=='exact_match' )){{{ "selected" }}} @endif>Exact Match</option>
                             </select>
                         </div>

                         <div class="col-lg-3 form-group form-group-search">
                             <span id="suggestion_text_span_{{$i}}">
                                 {!! Form::label('suggestion_text', 'Enter Text') !!}
                                 <input type="text" name="suggestion_text[{{$i}}]" value="<?php if (isset($inputValue)) {
                                 echo $inputValue['suggestion_text'][$i];
                                 } ?>" class='form-control suggestion_text{{$i}}' id='suggestion_venue_{{ $i }}' onblur='trim(this)' maxlength='255' autocomplete='off'>
                                 <span id="display_suggestion_venue_list" style="position:absolute;margin-top:-1px;display:none;overflow:hidden;background-color:white; z-index:9; width:97%"></span>
                             </span>

                             <span id="block_flag_span_{{$i}}" style="display:none;">
                                 {!! Form::label('Block', 'Select') !!}
                                 <select name="block_flag[{{$i}}]" id="block_flag_{{$i}}" class="js-states form-control" tabindex="-1" style="width:100%; height:38px;">
                                     <option value="Any">Any</option>
                                     <option value="1" @if(isset($inputValue) && ($inputValue['block_flag'][$i]=='1' )){{{ "selected" }}} @endif>Yes</option>
                                     <option value="0" @if(isset($inputValue) && ($inputValue['block_flag'][$i]=='0' )){{{ "selected" }}} @endif>No</option>
                                 </select>
                             </span>

                             
                             {{-- <span id="is_verified_span_{{$i}}" style="display:none;">
                                 {!! Form::label('Active', 'Select') !!}
                                 <select name="is_verified[{{$i}}]" id="is_verified_{{$i}}" class="js-states form-control" tabindex="-1" style="width:100%; height:38px;">
                                     <option value="Any">Any</option>
                                     <option value="1" @if(isset($inputValue) && ($inputValue['is_verified'][$i]=='1' )){{{ "selected" }}} @endif>Yes</option>
                                     <option value="0" @if(isset($inputValue) && ($inputValue['is_verified'][$i]=='0' )){{{ "selected" }}} @endif>No</option>
                                 </select>
                             </span> --}}

                             <span id="date_range_span_{{$i}}" style="display: none; width: 100%;">
                                 {!! Form::label('date_range', 'Date Range') !!} (m/d/Y)
                                 <input type="text" class="form-control date-range-piker-field date_range{{$i}}" name="datefilter[{{$i}}]" id="datepicker-range" value="<?php if (isset($inputValue)) {
                                                                                                                                                     echo $inputValue['datefilter'][$i];
                                                                                                                                                     } ?>" readonly required>
                             </span>
                         </div>
                         <div class="col-lg-2 form-group form-group-search" style="margin-top:20px !important">
                             @if($i == 0)
                             <button type="button" class="btn btn-primary btn-addon add-filter criteria-btn mt-2" id="{{$i}}"><i class="fa fa-plus" style="margin-right: 4px; font-weight: bold;"></i>Criteria</button>
                             @else
                             <button type="button" class="btn btn-danger remove-filter criteria-btn mt-3" id="{{$i}}"><i class="fa fa-times" style="margin-right: 4px; font-weight: bold;"></i> Criteria</button>
                             @endif
                         </div>

                         @if($i==0)
                         <!-- <div class="col-md-1"></div> -->
                         <div class="col-lg-1 form-group form-group-search" style="padding: 0;">
                             {!! Form::label('Limit', 'Limit') !!}
                             <select name="limit_flag" id="limit_flag" class="js-states form-control" tabindex="-1">
                                 <option value="50" @if(isset($inputValue) && ($inputValue['limit_flag']==50) || isset($default_limit)){{{ "selected" }}} @endif>50</option>
                                 <option value="100" @if(isset($inputValue) && ($inputValue['limit_flag']==100)){{{ "selected" }}} @endif>100</option>
                                 <option value="200" @if(isset($inputValue) && ($inputValue['limit_flag']==200)){{{ "selected" }}} @endif>200</option>
                                 <option value="500" @if(isset($inputValue) && ($inputValue['limit_flag']==500)){{{ "selected" }}} @endif>500</option>
                                 <option value="1000" @if(isset($inputValue) && ($inputValue['limit_flag']==1000)){{{ "selected" }}} @endif>1000</option>
                                 <option value="2000" @if(isset($inputValue) && ($inputValue['limit_flag']==2000)){{{ "selected" }}} @endif>2000</option>
                                 {{-- <option value="" @if(isset($inputValue) && ($inputValue['limit_flag']=="" )){{{ "selected" }}} @endif>All</option> --}}
                             </select>
                         </div>
                         <div class="col-lg-2 form-group form-group-search" style="margin-top:12px !important">
                             <button type="submit" class="btn btn-primary btn-addon m-y-sm seach-filter-btn mt-3 ms-2"style="width:130px;" ><i class="fa fa-search" style="margin-right: 4px;"></i> Filter/Apply</button>
                         </div>
                         
                         @endif
                     </div>
                 </div>
             <?php } ?>

             <input type="hidden" name="divToShow" id="divToShow" value="{{ $divToShow }}">
             <input type="hidden" name="formCount" id="formCount" value="{{ $formCount }}">
             {!! Form::close() !!}
         </div>
     </div>
 </div>
</div>

@section('javascript')
    <!-- Include your custom script -->
    {{-- <script src="{{ asset('assets/js/user_search.js') }}"></script> --}}
    <script src="/assets/js/search_script.js"></script>
@endsection


