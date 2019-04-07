<div class="card">
  <div class="card-header" id="headingOne">
    @foreach ($element_part->parts_for_region($region->id) as $part)
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#part-{{$part->id}}" aria-expanded="true" aria-controls="collapseOne">
              {{ $part->name }}
            </button>
          </h2>
        </div>
        <div id="part-{{$part->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            @foreach ($part->definitions as $definition)
              <p>{{$definition->definition}}</p>
            @endforeach
          </div>
    @endforeach
  </div>
</div>
