 <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      {{! $modules = Session('roles') }}
      @if(isset($modules))
	      @foreach($modules[0] as $llave => $valor)
	      	<a href="{{url('module/generateview/'.$llave)}}">{{ $valor[1] }}</a>
	      @endforeach
	  @endif    

</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Modulos</span>
<script>
      function openNav() {
          document.getElementById("mySidenav").style.width = "250px";
      }

      function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
      }
</script>