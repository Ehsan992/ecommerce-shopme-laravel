<style>
    .print_area {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
    }

    .heading_area {
        margin-bottom: 20px;
    }

    .company_name h3,
    .company_name h6 {
        margin: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    h6 {
        margin: 0;
        padding: 0;
        font-weight: normal;
    }

    @media (max-width: 768px) {
        .company_name h3 {
            font-size: 24px;
        }

        .company_name h6 {
            font-size: 14px;
        }

        th,
        td {
            padding: 6px;
            font-size: 14px;
        }
    }
</style>
<div class="print_area">
    <div class="heading_area">
        <div class="row">
            <div class="col-md-8">
                <div class="company_name text-center">
                    <h3><b>Shop Me </b></h3>
                    <h6>All Product Review</h6>
                </div>
            </div>
        </div>
    </div>
    <table class="w-100 table-bordered">
        <thead>
            <tr>
                <th>SL</th>
                <th>User</th>
                <th>Product Name</th>
                <th>Review</th>
                <th>Rating</th>
                <th>Predicted Emotion</th>
                <th>Review Date</th>
                <th>Review Month</th>
                <th>Review Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($review as $key => $row)
            <tr>
                <td>
                    <h6 class="p-0 m-0">{{ ++$key }}</h6>
                </td>
                <td>
                    <h6 class="p-0 m-0">{{ $row->email }}</h6>
                </td>
                <td>
                    <h6 class="p-0 m-0">{{ $row->name }}</h6>
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
                <td>
                    <h6 class="p-0 m-0">{{ $row->review_month }}</h6>
                </td>
                <td>
                    <h6 class="p-0 m-0">{{ $row->review_year }}</h6>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>