
<html>

	<br/>
	<h4>Tanggal : <?= $temp ?></h4>
	<table class="table" border="1">
		<thead style="background-color: yellow;">
			<tr>
				<th rowspan="2" class="cell" id="cell">Category</th>
				<th>@php $tgl1 = \Carbon\Carbon::parse($temp)->format('Y-m-d'); @endphp {{$tgl1}}</th>
				<th>@php $tgl2 = \Carbon\Carbon::parse($temp)->addDays(1)->format('Y-m-d'); @endphp {{ $tgl2 }}</th>
				<th>@php $tgl3 =  \Carbon\Carbon::parse($temp)->addDays(2)->format('Y-m-d'); @endphp {{ $tgl3 }}</th>
			</tr>
			<tr>
				<th>Amount</th>
				<th>Amount</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			@php $c1 	 = $category->where('name',"Salary")->first(); @endphp
			@php $dataC1tgl1 = $data->where('master_category_coa_id',$c1->id)->where('tanggal',$tgl1)->sum('credit') @endphp
			@php $dataC1tgl2 = $data->where('master_category_coa_id',$c1->id)->where('tanggal',$tgl2)->sum('credit') @endphp
			@php $dataC1tgl3 = $data->where('master_category_coa_id',$c1->id)->where('tanggal',$tgl3)->sum('credit') @endphp
			<tr style="background-color:#4DFC78">
				<td>{{ $c1->name }}</td>
				<td>{{ $dataC1tgl1 }}</td>
				<td>{{ $dataC1tgl2 }}</td>
				<td>{{ $dataC1tgl3 }}</td>
			</tr>
			@php $c2 = $category->where('name',"Other Income")->first(); @endphp
			@php $dataC2tgl1 = $data->where('master_category_coa_id',$c2->id)->where('tanggal',$tgl1)->sum('credit') @endphp
			@php $dataC2tgl2 = $data->where('master_category_coa_id',$c2->id)->where('tanggal',$tgl2)->sum('credit') @endphp
			@php $dataC2tgl3 = $data->where('master_category_coa_id',$c2->id)->where('tanggal',$tgl3)->sum('credit') @endphp

			<tr style="background-color:#4DFC78">
				<td>{{ $c2->name }}</td>
				<td>{{ $dataC2tgl1 }}</td>
				<td>{{ $dataC2tgl2 }}</td>
				<td>{{ $dataC2tgl3 }}</td>

			</tr>
			<tr style="background-color:#27BC4C">
				<td>Total Income</td>
				<td>{{ ((int)$dataC1tgl1 + (int)$dataC2tgl1) }}</td>
				<td>{{ ((int)$dataC1tgl2 + (int)$dataC2tgl2) }}</td>
				<td>{{ ((int)$dataC1tgl3 + (int)$dataC2tgl3) }}</td>
			</tr>
			@php $c3 = $category->where('name',"Family Expense")->first(); @endphp
			@php $dataC3tgl1 = $data->where('master_category_coa_id',$c3->id)->where('tanggal',$tgl1)->sum('debit') @endphp
			@php $dataC3tgl2 = $data->where('master_category_coa_id',$c3->id)->where('tanggal',$tgl2)->sum('debit') @endphp
			@php $dataC3tgl3 = $data->where('master_category_coa_id',$c3->id)->where('tanggal',$tgl3)->sum('debit') @endphp

			<tr style="background-color:#FF898C">
				<td>{{ $c3->name }}</td>
				<td>{{ $dataC3tgl1 }}</td>
				<td>{{ $dataC3tgl2 }}</td>
				<td>{{ $dataC3tgl3 }}</td>

			</tr>
			@php $c4 = $category->where('name',"Transport Expense")->first(); @endphp
			@php $dataC4tgl1 = $data->where('master_category_coa_id',$c4->id)->where('tanggal',$tgl1)->sum('debit') @endphp
			@php $dataC4tgl2 = $data->where('master_category_coa_id',$c3->id)->where('tanggal',$tgl2)->sum('debit') @endphp
			@php $dataC4tgl3 = $data->where('master_category_coa_id',$c3->id)->where('tanggal',$tgl3)->sum('debit') @endphp

			<tr style="background-color:#FF898C">
				<td>{{ $c4->name }}</td>
				<td>{{ $dataC4tgl1 }}</td>
				<td>{{ $dataC4tgl2 }}</td>
				<td>{{ $dataC4tgl3 }}</td>

			</tr>
			@php $c5 = $category->where('name',"Meal Expense")->first(); @endphp
			@php $dataC5tgl1 = $data->where('master_category_coa_id',$c5->id)->where('tanggal',$tgl1)->sum('debit') @endphp
			@php $dataC5tgl2 = $data->where('master_category_coa_id',$c5->id)->where('tanggal',$tgl2)->sum('debit') @endphp
			@php $dataC5tgl3 = $data->where('master_category_coa_id',$c5->id)->where('tanggal',$tgl3)->sum('debit') @endphp

			<tr style="background-color:#FF898C">
				<td>{{ $c5->name }}</td>
				<td>{{ $dataC5tgl1 }}</td>
				<td>{{ $dataC5tgl2 }}</td>
				<td>{{ $dataC5tgl3 }}</td>

			</tr>
			<tr style="background-color:#E15458">
				<td>Total Expense</td>
				<td>{{ ((int)$dataC3tgl1 + (int)$dataC4tgl1 + (int)$dataC5tgl1) }}</td>
				<td>{{ ((int)$dataC3tgl2 + (int)$dataC4tgl2 + (int)$dataC5tgl2) }}</td>
				<td>{{ ((int)$dataC3tgl3 + (int)$dataC4tgl3 + (int)$dataC5tgl3) }}</td>

			</tr>
			<tr>
				<td>Net Income</td>
				<td>{{ ((int)$dataC1tgl1 + (int)$dataC2tgl1 - (int)$dataC3tgl1 - (int)$dataC4tgl1 - (int)$dataC5tgl1) }}</td>
				<td>{{ ((int)$dataC1tgl2 + (int)$dataC2tgl2 - (int)$dataC3tgl2 - (int)$dataC4tgl2 - (int)$dataC5tgl2) }}</td>
				<td>{{ ((int)$dataC1tgl3 + (int)$dataC2tgl3 - (int)$dataC3tgl3 - (int)$dataC4tgl3 - (int)$dataC5tgl3) }}</td>

			</tr>

		</tbody>
	</table>
</html>