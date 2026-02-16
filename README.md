# TV Playout Backend

A comprehensive TV broadcast playout automation system built with Laravel, Filament, and Livewire. This system provides channel management, content scheduling, live streaming, distribution management, and automated playout capabilities for television broadcasting operations.

## Features

### Channel Management
- Create and manage multiple TV channels
- Configure channel settings and branding
- Role-based access control for channels
- Channel metadata and analytics integration

### Content Management System
- Media library with file upload and organization
- Folder-based content organization
- Content tagging and metadata management
- Version control for media assets
- Content preview and analytics
- Permission management for content access

### Scheduling & Automation
- Visual schedule editor with drag-and-drop
- Recurring schedule templates
- Automated playout engine
- Ad insertion and scheduling
- Conflict detection and alerts
- Content assignment to channels

### Live Streaming
- Live stream management and monitoring
- Multiple encoding profiles (ABR - Adaptive Bitrate)
- Stream recording and archiving
- Real-time monitoring dashboard
- Scheduled live broadcasts

### Distribution Management
- Multi-platform content distribution
- CDN configuration and management
- Platform connectors (YouTube, Facebook, etc.)
- Distribution monitoring and analytics
- API integrations for third-party services
- Alerting system for distribution issues

## Technology Stack

- **Framework**: Laravel 11
- **Admin Panel**: Filament 3
- **Frontend**: Livewire 3, Alpine.js, Tailwind CSS
- **Authentication**: Laravel Jetstream with Sanctum
- **Database**: MySQL/PostgreSQL
- **File Storage**: Local/S3 compatible storage

## Installation

1. Clone the repository
```bash
git clone https://github.com/stukenov/tv-playout-backend.git
cd tv-playout-backend
```

2. Install dependencies
```bash
composer install
npm install
```

3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Run migrations
```bash
php artisan migrate
```

6. Build assets
```bash
npm run build
```

7. Start the server
```bash
php artisan serve
```

## Usage

1. Register an account at `/register`
2. Access the admin panel at `/admin`
3. Create your first channel
4. Upload media content to the library
5. Create schedules and assign content
6. Configure live streams and distribution platforms
7. Monitor operations through the dashboard

## Key Models

- **Channel**: TV channels with settings and branding
- **Content**: Media content items
- **Schedule**: Playout schedules with timing
- **LiveStream**: Live broadcast configurations
- **Media**: File storage and metadata
- **Distribution**: Multi-platform distribution configs
- **Platform**: External distribution platforms
- **CDN**: Content delivery network settings

## API Integration

The system provides API endpoints for external integrations. Use Laravel Sanctum tokens for authentication.

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8.0+ or PostgreSQL 13+
- FFmpeg (for media processing)

## License

MIT License

Copyright (c) 2025 Saken Tukenov

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
