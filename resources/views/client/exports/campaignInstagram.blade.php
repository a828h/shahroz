<table>
    <thead>
        <tr>
            <th>@lang('client.campaignPublisher.name')</th>
            <th>@lang('client.campaignPublisher.impersion_cnt')</th>
            <th>@lang('client.campaignPublisher.reach_cnt')</th>
            <th>@lang('client.campaignPublisher.clicks_cnt')</th>
            <th>@lang('client.campaignPublisher.like_cnt')</th>
            <th>@lang('client.campaignPublisher.share_cnt')</th>
            <th>@lang('client.campaignPublisher.save_cnt')</th>
            <th>@lang('client.campaignPublisher.sticker_tap_cnt')</th>
            <th>@lang('client.campaignPublisher.comment_cnt')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if(count($campaign->contents))
        @foreach ($campaign->contents as $contentIndex => $content)
        @foreach($content->contentRows AS $contentRowsIndex => $row)
        <tr>
            @if($contentRowsIndex === 0)
                <td rowspan="{{count($content->contentRows)}}">
                    @foreach ($content->contentPublishers as $index => $contentPublisher)
                        {{ $contentPublisher->publisher->name . ($loop->last ? '' : '$|$|$') }}
                    @endforeach
                </td>
            @endif
            <td>{{number_format($row->impersion_cnt)}}</td>
            <td>{{number_format($row->reach_cnt)}}</td>
            <td>{{number_format($row->clicks_cnt)}}</td>
            <td>{{number_format($row->like_cnt)}}</td>
            <td>{{number_format($row->share_cnt)}}</td>
            <td>{{number_format($row->save_cnt)}}</td>
            <td>{{number_format($row->sticker_tap_cnt)}}</td>
            <td>{{number_format($row->comment_cnt)}}</td>
            @if($content->media_type === 'rows')
            <td>
                {{mediaDocuments($row)}}
            </td>
            @elseif($content->media_type !== 'rows' && $contentRowsIndex === 0)
                <td rowspan="{{count($content->contentRows)}}">
                    {{mediaDocuments($content)}}
                </td>
            @endif

        </tr>
        @endforeach
        @endforeach
        @endif
    </tbody>
</table>
