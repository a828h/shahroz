<ul class="nav nav-tabs nav-tabs-line">
    <li class="nav-item">
        <a class="nav-link {{ !isset($active) || $active === 'campaign' ? 'active' : '' }}" data-toggle="link" href="{{route('admin.campaigns.edit', $campaign->id)}}">@lang('admin.campaigns.general')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ isset($active) && $active === 'contents' ? 'active' : '' }}" data-toggle="link" href="{{route('admin.campaigns.edit', [$campaign->id, 'contents'])}}">@lang('admin.campaigns.campaignPublishers')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ isset($active) && $active === 'publishers' ? 'active' : '' }}" data-toggle="link" href="{{route('admin.campaigns.edit', [$campaign->id, 'publishers'])}}">@lang('admin.campaigns.newPublishers')</a>
    </li>
</ul>
