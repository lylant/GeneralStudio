using Microsoft.EntityFrameworkCore;
using NetCore.Data.DataModels;
using System;
using System.Collections.Generic;
using System.Text;

namespace NetCore.Services.Data
{
    // Fluent API

    // CodeFirstDbContext : Children Class
    // DbContext : Parent Class
    public class CodeFirstDbContext : DbContext
    {
        // Constructor Inheritance
        public CodeFirstDbContext(DbContextOptions<CodeFirstDbContext> options) : base(options)
        {
        }

        // Should have this to create a table list in the database
        public DbSet<User> Users { get; set; }


        // Method Inheritance, OnModelCreating method should be "virtual" from the parent class
        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            base.OnModelCreating(modelBuilder);

            // Name the DB table
            modelBuilder.Entity<User>().ToTable(name: "User");

            // Composition Key (we cannot set 2+ columns as the primary key with the data annotation only!)
            modelBuilder.Entity<UserRolesByUser>().HasKey(c => new { c.UserID, c.RoleID });

            // Default Values
            modelBuilder.Entity<User>(e =>
           {
               e.Property(c => c.IsMembershipWithdrawn).HasDefaultValue(value: false);
           });

            // Index
            modelBuilder.Entity<User>().HasIndex(c => new { c.UserEmail });
        }
    }
}
