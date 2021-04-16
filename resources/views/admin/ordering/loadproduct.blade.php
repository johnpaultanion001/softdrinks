<div class="row">
    @forelse($inventories as $inventory)
        <div class="col-xl-3 col-md-6">
                <div name="view" id="view" view="{{  $inventory->id ?? '' }}" class="card card-stats card-product text-left">
                <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{\Illuminate\Support\Str::limit($inventory->name,12)}}</h5>
                            <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0">{{ number_format($inventory->price , 0, ',', '.') }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="fas fa-wine-bottle"></i>
                            </div>
                        </div>
                        </div>
                        
                        <p class="mt-3 mb-0 text-sm">
                             <span class="text-nowrap text-success font-weight-bold">Size:
                              {{$inventory->size}} /
                            </span>
                            <span class="text-nowrap text-success  font-weight-bold">Stock:
                            @if($inventory->stock < 1)
                                <span class="text-nowrap  text-warning font-weight-bold">0</span>
                                @else
                                {{$inventory->stock}}
                                @endif
                            </span>
                            <span class="text-nowrap font-weight-bold">Expiration: {{$inventory->expiration}}</span>
                        </p>
                    </div>
                </div>
           
        </div>
    @empty
    <div class="col text-center">
        <div class="card">
             <h1 class="text-muted">Not Found</h1>
        </div>
    </div>
    
    @endforelse



</div>





