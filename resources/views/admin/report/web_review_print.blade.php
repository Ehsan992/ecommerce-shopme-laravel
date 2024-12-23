<div class="print_area">
    <div class="heading_area">
        <div class="row">
            <div class="col-md-8">
                <div class="company_name text-center">
                    <h3><b>Shope Me</b></h3>
                    <h6>All Web Review</h6>
                </div>
            </div>
        </div>
    </div>
    <table class="w-100 table-bordered">
        <thead>
            <tr>
                <th>SL</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Web Review</th>
                <th>Rating</th>
                <th>Predicted Emotion</th>
                <th>Review Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($webreviews as $key => $row)
            <tr>
                <td>
                    <h6 class="p-0 m-0">{{ ++$key }}</h6>
                </td>
                <td>
                    <h6 class="p-0 m-0">{{ $row->name }}</h6>
                </td>
                <td>
                    <h6 class="p-0 m-0">{{ $row->email }}</h6>
                </td>
                <td>
                    <h6 class="p-0 m-0">{{ $row->review }}</h6>
                </td>
                <td>
                    <h6 class="p-0 m-0">{{ $row->rating }}</h6>
                </td>
                <td>
                    <h6 class="p-0 m-0">
                        @if ($row->predicted_emotion == 'negative')
                        Negative
                        @elseif ($row->predicted_emotion == 'neutral')
                        Neutral
                        @elseif ($row->predicted_emotion == 'positive')
                        Positive
                        @endif
                    </h6>
                </td>
                <td>
                    <h6 class="p-0 m-0">{{ $row->review_date }}</h6>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>