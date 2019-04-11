@extends('layouts.admin')

@section('content')

<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>

<script type="text/javascript">
    //<![CDATA[

    jQuery(document).ready(function (){
        jQuery( "#images" ).sortable();
        jQuery( "#images" ).disableSelection();

        	//Display images
        jQuery(".input_image[value!='']").parent().find('div').each( function (index, element){
            jQuery(this).toggle();
        });

    });
    var imgId;
    function chooseFile(id)
    {
        imgId = id;
        var finder = new CKFinder();
        finder.basePath = "{{ asset('js/ckfinder/') }}"; // The path for the installation of CKFinder (default = "/ckfinder/").
        finder.selectActionFunction = setFileFieldFile;
        finder.popup();
    }
    function setFileFieldFile( fileUrl )
    {
        $('#chooseImage_div'+ imgId).html(fileUrl);
        document.getElementById( 'chooseImage_input' + imgId).value = fileUrl;
        document.getElementById( 'chooseImage_div' + imgId).style.display = '';
        document.getElementById( 'chooseImage_noImage_div' + imgId ).style.display = 'none';
    }

    function clearFile(imgId)
    {
        $('#chooseImage_div'+ imgId).html('');
        document.getElementById( 'chooseImage_input' + imgId ).value = '';
        document.getElementById( 'chooseImage_div' + imgId).style.display = 'none';
        document.getElementById( 'chooseImage_noImage_div' + imgId).style.display = '';
    }
    function chooseImage(id)
    {
        imgId = id;
        var finder = new CKFinder();
        finder.basePath = "{{ asset('js/ckfinder/') }}"; // The path for the installation of CKFinder (default = "/ckfinder/").
        finder.selectActionFunction = setFileField;
        finder.popup();
    }
    // This is a sample function which is called when a file is selected in CKFinder.
    function setFileField( fileUrl )
    {
        document.getElementById( 'chooseImage_img' + imgId ).src = fileUrl;
        document.getElementById( 'chooseImage_input' + imgId).value = fileUrl;
        document.getElementById( 'chooseImage_div' + imgId).style.display = '';
        document.getElementById( 'chooseImage_noImage_div' + imgId ).style.display = 'none';
    }
    function clearImage(imgId)
    {
        document.getElementById( 'chooseImage_img' + imgId ).src = '';
        document.getElementById( 'chooseImage_input' + imgId ).value = '';
        document.getElementById( 'chooseImage_div' + imgId).style.display = 'none';
        document.getElementById( 'chooseImage_noImage_div' + imgId).style.display = '';
    }

    function addMoreImg()
    {
        jQuery("ul#images > li.hidden").filter(":first").removeClass('hidden');
    }
    function removeType(id){
		$('#type_'+id).remove();
	}

//]]>
</script>
<style type="text/css">
    #images { list-style-type: none; margin: 0; padding: 0;}
    #images li { margin: 10px; float: left; text-align: center;}
</style>


<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="/admin/background-update-success/{{ $data['id'] }}" method="post" id="update-form" enctype="multipart/form-data">
          <div class="card">
              <div class="header">
                  <h2>
                      Background Advanced
                  </h2>
                  @csrf
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button type="button" onclick="javascript:update_confirm()" class="btn btn-primary m-t-15 waves-effect">Save</button>
              </div>
              <div class="body">
                @if (@$errors != '')
                <div class="alert alert-danger">
                    <strong>Errors!</strong> {{ $errors }}
                </div>
                @endif

                <h2 class="card-inside-title">name</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="data[name]" class="form-control" placeholder="name" value="{{ @$data['name'] }}" >
                    </div>
                </div>

                <br style="    clear: both;">
                <h2 class="card-inside-title">images</h2>
                <div class="body">


                    <footer class="panel-footer">
                      <div class="form-group">
                        <div class="col-md-10" style="    width: 100%;">
                          <p><a href="javascript:addMoreImg()">+ Add more images</a></p>
                                <ul id="images">
                                    @foreach($data['images'] as $i => $item)
                                     <li @if ($i >=2 && null == @$item['url']) class="hidden" @endif >
                                            <input class="input_image" type="hidden" id="chooseImage_input{{ $i }}" name="data[images][{{ $i }}][url]" value="@if( @$item['url'] ) {{ @$item['url'] }} @endif">
                                            <div id="chooseImage_div{{$i}}" style="display: none;">
                                                <img src="@if (@$item['url']) {{ @$item[url] }} @endif" id="chooseImage_img{{$i}}" style="max-width: 150px; max-height:150px; border:dashed thin;"></img>
                                            </div>
                                            <div id="chooseImage_noImage_div{{$i}}" style="width: 150px; border: thin dashed; text-align: center; padding:70px 0px;">
                                                No image
                                            </div>
                                            <br/>
                                            <br/>
                                            Width :
                                            <input class="input_image" type="text" id="chooseImage_input{{ $i }}" name="data[images][{{ $i }}][width]" value="{{ @$item[width] }}">

                                            Height :
                                            <input class="input_image" type="text" id="chooseImage_input{{ $i }}" name="data[images][{{ $i }}][height]" value="{{ @$item[height] }}">
                                            <a href="javascript:chooseImage({{$i}});">Choose image</a>
                                            |
                                            <a href="javascript:clearImage({{$i}});">Delete</a>
                                    </li>
                                    @endforeach
                                </ul>
                        </div>
                      </div>


                    </footer>


                </div>

                <br>
                <button type="button" onclick="javascript:update_confirm()" class="btn btn-primary m-t-15 waves-effect">Save</button>

              </div>
          </div>


        </form>
    </div>
</div>
<script>
    function update_confirm(id){

        var r = confirm("Do you want update this Product ?");
        if (r == true) {
            $('#update-form').submit();
        }

    }
</script>
@endsection
