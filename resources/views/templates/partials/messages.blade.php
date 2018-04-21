
    <div class="{{ Auth::user() ? 'col-10 offset-1' : 'col-4 offset-4' }}">
        @if (session('info') || isset($info))
            <div class="col-11 alert alert-light alert-dismissible text-info message">
                @if(session('info'))
                    @if(!is_array(session('info'))) 
                        {{ session('info') }} 
                    @else
                    <ul>
                        @foreach(session('info') as $info)
                            <li>{{ $info }}</li>
                        @endforeach
                        @php {{unset($info);}} @endphp
                    </ul>
                    @endif
                @elseif(isset($info))
                    @if(!is_array($info))
                        {{ $info }}
                    @else
                        <ul>
                            @foreach($info as $inf)
                                <li>{{ $inf }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endif
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @elseif (session('success') || isset($success))
            <div class="col-11 alert alert-light alert-dismissible text-success message">
                @if(session('success'))
                    @if(!is_array(session('success'))) 
                        {{ session('success') }} 
                    @else
                    <ul>
                        @foreach(session('success') as $success)
                            <li>{{ $success }}</li>
                        @endforeach
                        @php {{unset($success);}} @endphp
                    </ul>
                    @endif
                @elseif(isset($success))
                    @if(!is_array($success))
                        {{ $success }}
                    @else
                        <ul>
                            @foreach($success as $suc)
                                <li>{{ $suc }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endif
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @elseif (session('error') || $errors->any())
            <div class="col-11 alert alert-light alert-dismissible text-danger message">
                <h6><u>Er ging iets mis:</u></h6>
                @if(session('error'))
                    <ul>
                        @if(!is_array(session('error'))) 
                            <li>{{ session('error') }}</li>
                        @else
                            @foreach(session('error') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        @endif
                    </ul>
                @elseif($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div> 
               
        @endif
    </div>
