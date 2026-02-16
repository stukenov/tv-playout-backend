<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ChannelManagement\CreateChannel;
use App\Livewire\ChannelManagement\ConfigureChannel;
use App\Livewire\ChannelManagement\ManageMetadata;
use App\Livewire\ChannelManagement\CustomizeBranding;
use App\Livewire\ChannelManagement\CustomizeInterface;
use App\Livewire\ChannelManagement\CloneChannel;
use App\Livewire\ChannelManagement\SelectiveClone;
use App\Livewire\ChannelManagement\ManageChannelStatus;
use App\Livewire\ChannelManagement\ChannelAccessControl;
use App\Livewire\ChannelManagement\ContentIntegration;
use App\Livewire\ChannelManagement\ScheduleIntegration;
use App\Livewire\ChannelManagement\AnalyticsIntegration;
use App\Livewire\SchedulingAutomation\ScheduleListComponent;
use App\Livewire\SchedulingAutomation\ScheduleCreateComponent;
use App\Livewire\SchedulingAutomation\ScheduleEditComponent;
use App\Livewire\SchedulingAutomation\ContentAssignmentComponent;
use App\Livewire\SchedulingAutomation\RecurringScheduleComponent;
use App\Livewire\SchedulingAutomation\ConflictAlertComponent;
use App\Livewire\SchedulingAutomation\AutomatedPlayoutComponent;
use App\Livewire\SchedulingAutomation\AdInsertionComponent;
use App\Livewire\ContentManagement\MediaLibraryComponent;
use App\Livewire\ContentManagement\ContentAnalyticsComponent;
use App\Livewire\ContentManagement\ContentPreviewComponent;
use App\Livewire\ContentManagement\ContentTaggingComponent;
use App\Livewire\ContentManagement\FolderManagementComponent;
use App\Livewire\ContentManagement\MediaUploadComponent;
use App\Livewire\ContentManagement\MetadataComponent;
use App\Livewire\ContentManagement\PermissionsComponent;
use App\Livewire\ContentManagement\PlaylistManagementComponent;
use App\Livewire\ContentManagement\VersionControlComponent;
use App\Livewire\LiveStreaming\LiveStreamManager;
use App\Livewire\LiveStreaming\EncodingSettings;
use App\Livewire\LiveStreaming\ScheduleLiveStream;
use App\Livewire\LiveStreaming\LiveMonitoringDashboard;
use App\Livewire\LiveStreaming\ABRSettings;
use App\Livewire\LiveStreaming\StreamRecorder;
use App\Livewire\DistributionManagement\AlertingSystemComponent;
use App\Livewire\DistributionManagement\APIIntegrationComponent;
use App\Livewire\DistributionManagement\CDNConfigurationComponent;
use App\Livewire\DistributionManagement\ContentDistributionComponent;
use App\Livewire\DistributionManagement\DistributionDashboardComponent;
use App\Livewire\DistributionManagement\MonitoringAnalyticsComponent;
use App\Livewire\DistributionManagement\PlatformConnectorComponent;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/channels/create', CreateChannel::class)->name('channels.create');
    
    Route::prefix('channels/{channelId}')->group(function () {
        Route::get('/configure', ConfigureChannel::class)->name('channels.configure');
        Route::get('/metadata', ManageMetadata::class)->name('channels.metadata');
        Route::get('/branding', CustomizeBranding::class)->name('channels.branding');
        Route::get('/interface', CustomizeInterface::class)->name('channels.interface');
        Route::get('/clone', CloneChannel::class)->name('channels.clone');
        Route::get('/selective-clone', SelectiveClone::class)->name('channels.selective-clone');
        Route::get('/status', ManageChannelStatus::class)->name('channels.status');
        Route::get('/access-control', ChannelAccessControl::class)->name('channels.access-control');
        Route::get('/content', ContentIntegration::class)->name('channels.content');
        Route::get('/schedule', ScheduleIntegration::class)->name('channels.schedule');
        Route::get('/analytics', AnalyticsIntegration::class)->name('channels.analytics');
    });
    
    Route::prefix('scheduling')->group(function () {
        Route::get('/schedules', ScheduleListComponent::class)->name('scheduling.schedules.list');
        Route::get('/schedules/create', ScheduleCreateComponent::class)->name('scheduling.schedules.create');
        Route::get('/schedules/edit/{scheduleId}', ScheduleEditComponent::class)->name('scheduling.schedules.edit');
        Route::get('/content-assignment', ContentAssignmentComponent::class)->name('scheduling.content.assignment');
        Route::get('/recurring-schedules', RecurringScheduleComponent::class)->name('scheduling.recurring.schedules');
        Route::get('/conflict-alerts', ConflictAlertComponent::class)->name('scheduling.conflict.alerts');
        Route::get('/automated-playout', AutomatedPlayoutComponent::class)->name('scheduling.automated.playout');
        Route::get('/ad-insertion', AdInsertionComponent::class)->name('scheduling.ad.insertion');
    });

    Route::get('/content/media-library', MediaLibraryComponent::class)->name('content.media.library');
    // TODO: Fix media upload component (Cannot read properties of undefined (reading 'name'))
    Route::get('/content/media-upload', MediaUploadComponent::class)->name('content.media.upload'); 
    Route::get('/content/folder-management', FolderManagementComponent::class)->name('content.folder.management');
    Route::prefix('content/{mediaId}')->group(function () {
        Route::get('/analytics', ContentAnalyticsComponent::class)->name('content.analytics');
        Route::get('/content-preview', ContentPreviewComponent::class)->name('content.preview');
        Route::get('/content-tagging', ContentTaggingComponent::class)->name('content.tagging');
        Route::get('/metadata', MetadataComponent::class)->name('content.metadata');
        Route::get('/permissions', PermissionsComponent::class)->name('content.permissions');
        Route::get('/version-control', VersionControlComponent::class)->name('content.version.control');
    });

    Route::prefix('distribution')->group(function () {
        Route::get('/alerting-system', AlertingSystemComponent::class)->name('distribution.alerting.system');
        Route::get('/api-integration', APIIntegrationComponent::class)->name('distribution.api.integration');
        Route::get('/cdn-configuration', CDNConfigurationComponent::class)->name('distribution.cdn.configuration');
        Route::get('/content-distribution', ContentDistributionComponent::class)->name('distribution.content.distribution');
        Route::get('/distribution-dashboard', DistributionDashboardComponent::class)->name('distribution.distribution.dashboard');
        Route::get('/monitoring-analytics', MonitoringAnalyticsComponent::class)->name('distribution.monitoring.analytics');
        Route::get('/platform-connector', PlatformConnectorComponent::class)->name('distribution.platform.connector');
    });
    Route::prefix('live')->group(function () {
        Route::get('/', LiveStreamManager::class)->name('live.manager');
        Route::get('/encoding', EncodingSettings::class)->name('live.encoding');
        Route::get('/schedule', ScheduleLiveStream::class)->name('live.schedule');
        Route::get('/monitoring', LiveMonitoringDashboard::class)->name('live.monitoring');
        Route::get('/abr-settings', ABRSettings::class)->name('live.abr-settings');
        Route::get('/recorder', StreamRecorder::class)->name('live.recorder');
    });
});