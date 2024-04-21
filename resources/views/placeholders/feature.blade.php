<div>
<html>
<head>
<style>

.container {

  margin-bottom: 4em;
}

%loading-skeleton {
  color: transparent;
  appearance: none;
  -webkit-appearance: none;
  background-color: #eee;
  border-color: #eee;

  {{-- &::placeholder {
    color: transparent;
  } --}}
}
@keyframes loading-skeleton {
  from {
    opacity: .4;
  }
  to {
    opacity: 1;
  }
}
.loading-skeleton {
  pointer-events: none;
  animation: loading-skeleton 1s infinite alternate;
  
  img {
    filter: grayscale(100) contrast(0%) brightness(1.8);
  }
  h1, h2, h3, h4, h5, h6,
  p, li,
  .btn,
  label,
  .form-control {
      color: transparent;
  appearance: none;
  -webkit-appearance: none;
  background-color: #eee;
  border-color: #eee;
  }
}
    
</style>
</head>

<body>

<div class="container-fluid loading-skeleton">
<div class="row">

<?php $var=[0,1,2,3,4,5,6,7,8,9,10,11,12,12,12,121,12,12,12,23];?>
@foreach ($var as $k )

<div class="col-md-3 col-6">
<div class="card">
<img src="//placebear.com/300/200" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn ">Go somewhere</a> --}}
  </div>
</div>

</div>
@endforeach
  

  

  </div>


</div>

</div>

</body>
</html>

</div>