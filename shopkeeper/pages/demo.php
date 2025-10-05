<?php



$message = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Order Confirmation - Vendor Dashboard</title>
</head>
<body style='margin: 0; padding: 20px; background-color: #f3f4f6; font-family: " . 'Inter' . ", -apple-system, BlinkMacSystemFont, " . 'Segoe UI' . ", Roboto, sans-serif; color: #1f2937; line-height: 1.6;'>
    <!-- Email Container -->
    <div style='max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);'>
        
        <!-- Email Header -->
        <div style='background: linear-gradient(135deg, #4f46e5, #6366f1); color: white; padding: 30px 20px; text-align: center;'>
            <h1 style='font-size: 24px; margin-bottom: 10px;'>Thank You For Your Order!</h1>
            <p style='opacity: 0.9;'>Your order has been confirmed and is being processed</p>
        </div>
        
        <!-- Email Body -->
        <div style='padding: 30px;'>
            
            <!-- Order Confirmation -->
            <div style='text-align: center; margin-bottom: 30px;'>
                <div style='font-size: 48px; color: #10b981; margin-bottom: 15px;'>✓</div>
                <h2 style='font-size: 20px; margin-bottom: 10px;'>Order Confirmed</h2>
                <p>We've received your order and will notify you when it ships.</p>
            </div>
            
            <!-- Order Details -->
            <div style='background-color: #f9fafb; border-radius: 8px; padding: 20px; margin-bottom: 25px;'>
                <div style='display: flex; justify-content: space-between; flex-wrap: wrap; gap: 15px;'>
                    <div style='flex: 1; min-width: 150px;'>
                        <div style='font-size: 14px; color: #6b7280; display: block; margin-bottom: 5px;'>ORDER NUMBER</div>
                        <span style='color: #4f46e5; font-weight: 600;'>#ORD-$order</span>
                    </div>
                    <div style='flex: 1; min-width: 150px;'>
                        <div style='font-size: 14px; color: #6b7280; display: block; margin-bottom: 5px;'>ORDER DATE</div>
                        <span style='font-weight: 500;'>$date</span>
                    </div>
                    <div style='flex: 1; min-width: 150px;'>
                        <div style='font-size: 14px; color: #6b7280; display: block; margin-bottom: 5px;'>TOTAL AMOUNT</div>
                        <span style='font-weight: 500;'>₹$totalAmount</span>
                    </div>
                    <div style='flex: 1; min-width: 150px;'>
                        <div style='font-size: 14px; color: #6b7280; display: block; margin-bottom: 5px;'>PAYMENT METHOD</div>
                        <span style='font-weight: 500;'>On Shop</span>
                    </div>
                </div>
            </div>
            
            <!-- Order Items -->
            <div style='margin-bottom: 25px;'>
                <h3 style='font-size: 18px; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #e5e7eb;'>Order Items</h3>
                
                <!-- Item 1 -->
                <div style='display: flex; align-items: center; padding: 15px 0; border-bottom: 1px solid #e5e7eb;'>
                    <div style='width: 60px; height: 60px; border-radius: 6px; background-color: #f9fafb; margin-right: 15px; display: flex; align-items: center; justify-content: center; color: #6b7280;'>🎧</div>
                    <div style='flex: 1;'>
                        <div style='font-weight: 500; margin-bottom: 5px;'>Wireless Headphones Pro</div>
                        <div style='color: #6b7280; font-size: 14px;'>₹1,299 × 2</div>
                    </div>
                    <div style='font-weight: 600;'>₹2,598</div>
                </div>
                
                <!-- Item 2 -->
                <div style='display: flex; align-items: center; padding: 15px 0; border-bottom: 1px solid #e5e7eb;'>
                    <div style='width: 60px; height: 60px; border-radius: 6px; background-color: #f9fafb; margin-right: 15px; display: flex; align-items: center; justify-content: center; color: #6b7280;'>📱</div>
                    <div style='flex: 1;'>
                        <div style='font-weight: 500; margin-bottom: 5px;'>Phone Case</div>
                        <div style='color: #6b7280; font-size: 14px;'>₹499 × 1</div>
                    </div>
                    <div style='font-weight: 600;'>₹499</div>
                </div>
                
                <!-- Item 3 -->
                <div style='display: flex; align-items: center; padding: 15px 0;'>
                    <div style='width: 60px; height: 60px; border-radius: 6px; background-color: #f9fafb; margin-right: 15px; display: flex; align-items: center; justify-content: center; color: #6b7280;'>⚡</div>
                    <div style='flex: 1;'>
                        <div style='font-weight: 500; margin-bottom: 5px;'>Fast Charger</div>
                        <div style='color: #6b7280; font-size: 14px;'>₹749 × 1</div>
                    </div>
                    <div style='font-weight: 600;'>₹749</div>
                </div>
            </div>
            
            <!-- Billing Summary -->
            <div style='background-color: #f9fafb; border-radius: 8px; padding: 20px; margin-bottom: 25px;'>
                <h3 style='font-size: 18px; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #e5e7eb;'>Order Summary</h3>
                
                <div style='display: flex; justify-content: space-between; margin-bottom: 10px;'>
                    <span>Subtotal:</span>
                    <span>₹3,846</span>
                </div>
                
                <div style='display: flex; justify-content: space-between; margin-bottom: 10px;'>
                    <span>Shipping:</span>
                    <span>₹0</span>
                </div>
                
                <div style='display: flex; justify-content: space-between; margin-bottom: 10px;'>
                    <span>Tax (12%):</span>
                    <span>₹461</span>
                </div>
                
                <div style='display: flex; justify-content: space-between; margin-bottom: 10px;'>
                    <span>Discount:</span>
                    <span>-₹465</span>
                </div>
                
                <div style='display: flex; justify-content: space-between; font-weight: 600; font-size: 18px; border-top: 1px solid #e5e7eb; padding-top: 10px; margin-top: 10px;'>
                    <span>Total:</span>
                    <span>₹3,842</span>
                </div>
            </div>
            
            <!-- Shipping Information -->
            <div style='margin-bottom: 25px;'>
                <h3 style='font-size: 18px; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #e5e7eb;'>Shipping Information</h3>
                
                <div style='display: flex; gap: 30px;'>
                    <div style='flex: 1;'>
                        <h4 style='font-size: 16px; margin-bottom: 10px;'>Shipping Address</h4>
                        <p style='color: #6b7280; line-height: 1.5;'>
                            Rahul Sharma<br>
                            123 Main Street<br>
                            Mumbai, Maharashtra 400001<br>
                            India<br>
                            Phone: +91 98765 43210
                        </p>
                    </div>
                    
                    <div style='flex: 1;'>
                        <h4 style='font-size: 16px; margin-bottom: 10px;'>Billing Address</h4>
                        <p style='color: #6b7280; line-height: 1.5;'>
                            Same as shipping address
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Next Steps -->
            <div style='background-color: #eff6ff; border-radius: 8px; padding: 20px; margin-bottom: 25px; border-left: 4px solid #4f46e5;'>
                <h3 style='font-size: 18px; margin-bottom: 10px; color: #4f46e5;'>What's Next?</h3>
                <ul style='padding-left: 20px; margin-bottom: 15px;'>
                    <li style='margin-bottom: 8px; color: #6b7280;'>We'll send you a confirmation when your order ships</li>
                    <li style='margin-bottom: 8px; color: #6b7280;'>You can track your order using the link below</li>
                    <li style='margin-bottom: 8px; color: #6b7280;'>Expected delivery: 3-5 business days</li>
                </ul>
                <a href='#' style='display: inline-block; background-color: #4f46e5; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-weight: 500; margin-top: 10px;'>Track Your Order</a>
            </div>
        </div>
        
        <!-- Email Footer -->
        <div style='text-align: center; padding: 20px; background-color: #f9fafb; color: #6b7280; font-size: 14px;'>
            <p>Thank you for shopping with us!</p>
            <p>If you have any questions about your order, please contact our customer service team.</p>
            
            <div style='margin-top: 15px;'>
                <p>Email: <a href='mailto:support@vendordashboard.com' style='color: #4f46e5; text-decoration: none;'>support@vendordashboard.com</a></p>
                <p>Phone: <a href='tel:+911800123456' style='color: #4f46e5; text-decoration: none;'>1-800-123-456</a></p>
            </div>
            
            <p style='margin-top: 20px;'>&copy; 2023 Vendor Dashboard. All rights reserved.</p>
        </div>
    </div>
</body>
</html>";
