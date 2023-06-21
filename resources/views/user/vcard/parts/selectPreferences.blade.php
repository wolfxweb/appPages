<div class="form-group">
    <label for="{{$nome}}">{{$titulo}}</label>
    <select name="{{$nome}}" id="{{$nome}}" class="form-control" >
        <option value='1' {{$possicao=='1'?'selected':""}}>1</option>
        <option value='2' {{$possicao=='2'?'selected':""}}>2</option>
        <option value='3' {{$possicao=='3'?'selected':""}}>3</option>
        <option value='4' {{$possicao=='4'?'selected':""}}>4</option>
        <option value='5' {{$possicao=='5'?'selected':""}}>5</option>
        <option value='6' {{$possicao=='6'?'selected':""}}>6</option>
        <option value='7' {{$possicao=='7'?'selected':""}}>7</option>
    </select>
</div>