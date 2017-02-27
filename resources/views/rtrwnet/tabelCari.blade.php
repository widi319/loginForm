<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
<thead>
    <tr>

        <th>User Name</th>

    </tr>
</thead>
<tfoot>
     <tr>

        <th>User Name</th>

    </tr>
</tfoot>
<tbody>
   @foreach($data as $rtrwz)


<tr style="cursor:pointer" ondblclick="isiText('{{$rtrwz->email}}','{{$rtrwz->id}}');">

<td>{{$rtrwz->email}}</td>

</tr>
@endforeach
</tbody>
</table>
