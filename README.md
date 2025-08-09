# NexaDrive - Car Rental Management System

A modern, futuristic car rental management system built with Laravel and Tailwind CSS, designed specifically for admin users to manage vehicle fleets efficiently.

## 🚗 About NexaDrive

NexaDrive is a comprehensive car rental management system that provides a sleek, modern interface for managing vehicle fleets. The system features a beautiful, responsive design with dark mode support and intuitive user experience.

## ✨ Features Implemented

### 🔐 Authentication System

-   **Login/Registration**: Complete authentication system with user registration
-   **Session Management**: Automatic redirects for authenticated users
-   **Security**: Protected routes with middleware
-   **Default Admin**: Pre-configured admin user (admin@nexadrive.com / admin123)

### 🎨 Modern UI/UX Design

-   **Responsive Design**: Works seamlessly on desktop, tablet, and mobile
-   **Dark Mode**: Toggle between light and dark themes with persistent preference
-   **Futuristic Design**: Modern gradients, shadows, and hover effects
-   **Tailwind CSS v4**: Latest styling with custom components and dark mode support
-   **Cross-Page Consistency**: Dark mode works across all pages automatically
-   **Enhanced Visibility**: Optimized text contrast and readability in dark mode

### 🏠 Dashboard

-   **Welcome Interface**: Personalized greeting for admin users
-   **Statistics Cards**: Real-time fleet statistics
-   **Quick Actions**: Easy access to system features
-   **Recent Activity**: System status and activity overview

### 🚙 Vehicle Management

-   **Vehicle Listing**: Beautiful card-based vehicle display with hover effects
-   **Add Vehicles**: Comprehensive form with 16 vehicle fields:
    -   Car ID, License Plate, Make, Model, Year
    -   Color, Car Type, Transmission, Fuel Type
    -   Daily Rate, Availability, Mileage, Seating Capacity
    -   Insurance, Last Service, Condition
-   **Image Upload**: Support for up to 3 images per vehicle with preview
-   **Image Preview**: Real-time image preview with removal capability
-   **Database Storage**: Complete data persistence with image storage
-   **Edit Vehicles**: Full-screen edit interface with image management
-   **Rent Vehicles**: Dedicated rent page with renter info, date range, editable pricing, auto-calculated totals
-   **Delete Vehicles**: Confirmation modal with success messages
-   **Image Management**: Add/remove images with preview functionality

### 📄 Vehicle Details Page

-   **Dedicated Page**: Full, read-only details page (replaces modal)
-   **Image Gallery**: Large main image with clickable thumbnails
-   **Comprehensive Info**: All vehicle details organized in sections:
    -   Basic Information (Make, Model, Year, Color, Type, Plate)
    -   Specifications (Transmission, Fuel, Seating, Mileage)
    -   Pricing & Status (Daily Rate, Availability Status)
    -   Additional Information (Insurance, Condition, Last Service)
-   **Modern Interactions**: Smooth transitions, dark-mode friendly

### 🎯 Interactive Features

-   **Hover Effects**: Beautiful hover animations on vehicle cards
-   **Status Badges**: Animated availability indicators
-   **Quick Actions**: View, Rent, Edit, Delete actions on each card
-   **Mobile Responsive**: Optimized sidebar and navigation
-   **Delete Confirmation**: Modal with loading states and success messages
-   **Image Management**: Add/remove images with real-time preview
-   **Form Validation**: Client-side and server-side validation
-   **Success Messages**: User feedback for all CRUD operations

## 🛠 Technical Stack

### Backend

-   **Laravel 10**: PHP framework for robust backend
-   **SQLite**: Lightweight database for development
-   **Eloquent ORM**: Database interactions and relationships
-   **File Storage**: Laravel Storage facade for image management

### Frontend

-   **Blade Templates**: Laravel's templating engine
-   **Tailwind CSS v4**: Latest utility-first CSS framework with dark mode
-   **JavaScript**: Interactive features and animations
-   **Vite**: Asset compilation and hot reloading
-   **Dark Mode System**: Global dark mode with localStorage persistence
-   **Custom CSS**: Enhanced dark mode styles for optimal visibility
-   **Accessible Colors**: Sidebar, cards, and modals tuned for contrast

### Database Schema

```sql
vehicles table:
- car_id (unique)
- license_plate (unique)
- make, model, year, color
- car_type, transmission, fuel_type
- daily_rate, availability, mileage
- seating_capacity, insurance
- last_service, condition
- images (JSON array)
```

## 🚀 Getting Started

### Prerequisites

-   PHP 8.1+
-   Composer
-   Node.js & NPM

### Installation

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd CarRental
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies**

    ```bash
    npm install
    ```

4. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Database setup**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

6. **Storage setup**

    ```bash
    php artisan storage:link
    ```

7. **Build assets**

    ```bash
    npm run build
    ```

8. **Start the server**
    ```bash
    php artisan serve
    ```

### Renting Flow

-   From `Vehicles` page, click `Rent` on any vehicle card
-   Fill renter info (name, ID, contact), choose dates
-   Adjust daily rate, discount, and extra fees if needed
-   Totals auto-calculate (days, subtotal, total)
-   Submit to save (extend to persist rentals later)

### Dark Mode Setup

The system includes a comprehensive dark mode system that:

-   Persists user preference across sessions
-   Works across all pages automatically
-   Provides optimal text contrast and readability
-   Includes enhanced CSS styles for all components

### Default Login

-   **Email**: admin@nexadrive.com
-   **Password**: admin123

## 📁 Project Structure

```
CarRental/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php      # Authentication logic
│   │   └── VehicleController.php   # Vehicle management
│   └── Models/
│       ├── User.php               # User model
│       └── Vehicle.php            # Vehicle model
├── database/
│   ├── migrations/                # Database schema
│   └── seeders/                   # Initial data
├── resources/views/
│   ├── auth/                      # Login/Register views
│   ├── components/                # Reusable components
│   ├── vehicles/                  # Vehicle management views
│   └── dashboard.blade.php        # Main dashboard
├── routes/
│   └── web.php                    # Application routes
└── public/
    └── css/app.css               # Fallback styles
```

## 🎨 Design Philosophy

### Modern & Futuristic

-   Clean, minimalist design
-   Smooth animations and transitions
-   Gradient backgrounds and modern shadows
-   Responsive grid layouts
-   Dark mode support with optimal contrast

### User Experience

-   Intuitive navigation
-   Clear visual hierarchy
-   Consistent design language
-   Mobile-first approach
-   Persistent user preferences

### Performance

-   Optimized asset loading
-   Efficient database queries
-   Responsive image handling
-   Fast page transitions
-   Optimized dark mode rendering

## 🔧 Development Features

### Code Quality

-   Clean, readable code structure
-   Proper separation of concerns
-   Consistent naming conventions
-   Modular component design

### Security

-   CSRF protection
-   Input validation
-   File upload security
-   Authentication middleware
-   Image validation and sanitization
-   Secure file storage

### Scalability

-   Modular architecture
-   Reusable components
-   Database optimization
-   Asset management
-   Image storage optimization
-   Dark mode system scalability

## 🚀 Future Enhancements

### Planned Features

-   [ ] Rental booking system
-   [ ] Customer management
-   [ ] Payment integration
-   [ ] Maintenance scheduling
-   [ ] Reports and analytics
-   [ ] Email notifications
-   [ ] API endpoints
-   [ ] Mobile app integration
-   [ ] Advanced image management
-   [ ] Bulk operations
-   [ ] Vehicle categories
-   [ ] Maintenance history

### Technical Improvements

-   [ ] Unit and feature tests
-   [ ] API documentation
-   [ ] Performance optimization
-   [ ] Advanced search/filtering
-   [ ] Export functionality
-   [ ] Backup system
-   [ ] Image optimization
-   [ ] Caching system
-   [ ] Real-time updates

## 📝 License

This project is developed for educational and demonstration purposes.

## 🤝 Contributing

This is a personal project showcasing modern web development practices with Laravel and Tailwind CSS.

---

**NexaDrive** - Where modern design meets efficient fleet management. 🚗✨
