# Multi-Level Commenting System

A Laravel-based multi-level commenting system with recursive depth checking, supporting nested replies up to 3 levels deep.

## 🚀 Features

- **Multi-Level Comments**: Support for nested replies up to 3 levels deep
- **Recursive Depth Check**: Automatic validation to prevent exceeding maximum depth
- **Modern UI**: Clean, responsive design with Bootstrap 5
- **Real-time Interactions**: AJAX-based comment submission and replies
- **Scheduled Cleanup**: Automated command to delete empty comments
- **User Authentication**: Built-in Laravel authentication system

## 📋 Requirements

- PHP 8.1 or higher
- Laravel 11 or above
- MySQL/PostgreSQL/SQLite
- Composer

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd multilevelcomments
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=multilevelcomments
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

7. **Access the application**
   Open your browser and navigate to `http://localhost:8000`

## 🗄️ Database Structure

### Posts Table
- `id` - Primary key
- `title` - Post title
- `body` - Post content
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp

### Comments Table
- `id` - Primary key
- `content` - Comment content
- `post_id` - Foreign key to posts table
- `parent_comment_id` - Self-referencing foreign key for replies
- `depth` - Comment depth level (0-3)
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp

## 🔧 Usage

### Creating Posts
1. Navigate to the posts page
2. Click "Create New Post"
3. Fill in the title and content
4. Click "Publish Post"

### Adding Comments
1. View any post
2. Scroll to the comments section
3. Enter your comment in the textarea
4. Click "Post Comment"

### Replying to Comments
1. Click the "Reply" button on any comment
2. Enter your reply in the modal
3. Click "Post Reply"
4. **Note**: Replies are limited to 3 levels deep

### Managing Comments
- **Delete**: Use the dropdown menu on any comment
- **Depth Limit**: Comments at level 3 cannot have replies

## ⚙️ Commands

### Delete Empty Comments
Manually run the scheduled command to delete comments with empty content:

```bash
php artisan comments:delete-empty
```

### Schedule Runner
To run scheduled tasks manually:

```bash
php artisan schedule:run
```

## 🏗️ Architecture

### Models

#### Post Model
- `comments()` - Has many top-level comments
- `allComments()` - Has many all comments (including replies)

#### Comment Model
- `post()` - Belongs to a post
- `parent()` - Belongs to a parent comment
- `replies()` - Has many reply comments
- `allReplies()` - Recursive relationship for all replies
- `canHaveReplies()` - Check if comment can have replies
- `calculateDepth()` - Calculate depth for new comments
- `wouldExceedMaxDepth()` - Validate depth limit

### Controllers

#### PostController
- Standard CRUD operations for posts
- Pagination support

#### CommentController
- `store()` - Create new comments with depth validation
- `getComments()` - Retrieve comments for a post
- `destroy()` - Delete comments

### Views

#### Recursive Comment Display
- `comments/comment-item.blade.php` - Recursive partial for comment display
- Automatic depth checking and indentation
- Reply functionality with depth validation

## 🔒 Security Features

- CSRF protection on all forms
- Input validation and sanitization
- SQL injection prevention through Eloquent ORM
- XSS protection through Blade templating

## 🎨 UI/UX Features

- **Responsive Design**: Works on all device sizes
- **Modern Interface**: Clean, professional appearance
- **Visual Hierarchy**: Clear comment threading with indentation
- **Interactive Elements**: Hover effects and smooth transitions
- **Depth Indicators**: Visual cues for comment levels
- **User Feedback**: Success/error messages and confirmations

## 🧪 Testing

The application includes:
- Form validation testing
- Depth limit enforcement
- Database relationship integrity
- Scheduled command functionality

## 📝 API Endpoints

### Comments
- `POST /comments` - Create a new comment
- `GET /posts/{post}/comments` - Get comments for a post
- `DELETE /comments/{comment}` - Delete a comment

### Posts
- Standard RESTful routes for post management

## 🚀 Deployment

### Recommended Platforms
- **Railway**: Easy deployment with automatic scaling
- **Render**: Free tier available with good performance
- **Heroku**: Reliable platform with add-ons
- **Vercel**: Fast deployment with edge functions

### Deployment Steps
1. Set up your hosting platform
2. Configure environment variables
3. Run `composer install --optimize-autoloader --no-dev`
4. Run `php artisan migrate --force`
5. Set up a cron job for scheduled tasks (if needed)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Check the Laravel documentation
- Review the code comments for implementation details

## 🔄 Version History

- **v1.0.0** - Initial release with multi-level commenting system
- Basic CRUD operations for posts and comments
- Recursive depth checking (3 levels max)
- Scheduled cleanup command
- Modern responsive UI

---

**Built with ❤️ using Laravel 11**
