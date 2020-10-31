<table id="myTable" class="table table-head-custom table-head-bg table-bordered table-vertical-center">
    <thead>
        <tr class="text-left text-uppercase">
            <th style="min-width: 250px" class="pl-7">
                <span class="text-dark-75">@lang('client.campaignPublisher.name')</span>
            </th>
            <th style="min-width: 100px">@lang('client.campaignPublisher.impersion_cnt')</th>
            <th style="min-width: 100px">@lang('client.campaignPublisher.reach_cnt')</th>
            <th style="min-width: 100px">@lang('client.campaignPublisher.clicks_cnt')</th>
            <th style="min-width: 100px">@lang('client.campaignPublisher.like_cnt')</th>
            <th style="min-width: 100px">@lang('client.campaignPublisher.share_cnt')</th>
            <th style="min-width: 100px">@lang('client.campaignPublisher.save_cnt')</th>
            <th style="min-width: 100px">@lang('client.campaignPublisher.sticker_tap_cnt')</th>
            <th style="min-width: 100px">@lang('client.campaignPublisher.comment_cnt')</th>
        </tr>
    </thead>
    <tbody>
        @if(count($campaign->contents))
        @foreach ($campaign->contents as $contentIndex => $content)
        @foreach($content->contentRows AS $contentRowsIndex => $row)
        <tr style="border-top: {{ $contentRowsIndex === 0 ? '1px solid #ccc' : '' }}">
            @if($contentRowsIndex === 0)
            <td rowspan="{{count($content->contentRows)}}" style="padding: 0;">
                @php
                $publishers=[];
                foreach ($content->contentPublishers as $contentPublisher) {
                    $publishers[] = $contentPublisher->publisher->name;
                }
                @endphp

                {{implode('$|$|$', $publishers)}}
            </td>
            @endif
            <td>{{number_format($row->impersion_cnt)}}</td>
            <td>{{number_format($row->reach_cnt)}}</td>
            <td>{{number_format($row->clicks_cnt)}}</td>
            <td>{{number_format($row->like_cnt)}}</td><td>{{number_format($row->share_cnt)}}</td>
            <td>{{number_format($row->save_cnt)}}</td>
            <td>{{number_format($row->sticker_tap_cnt)}}</td>
            <td>{{number_format($row->comment_cnt)}}</td>
        </tr>
        @endforeach
        @endforeach
        @endif
    </tbody>
</table>
