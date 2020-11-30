using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using NetCore.Data.ViewModels;
using NetCore.Services.Interfaces;
using NetCore.Services.Svcs;
using NetCore.Web.Models;

namespace NetCore.Web.Controllers
{
    public class MembershipController : Controller
    {
        private IUser _user = new UserService();

        public IActionResult Index()
        {
            return View();
        }

        [HttpGet]
        public IActionResult Login()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken] // validate by using anti-forgery token. use this attribute for all POST requests
        // (Data =>) Services => Web
        // Data => Services
        // Data => Web
        public IActionResult Login(LoginInfo login)
        {
            string message = string.Empty;

            if (ModelState.IsValid)
            {
                // ViewModel
                // User Service
                if (_user.MatchUserInfo(login))
                {
                    TempData["Message"] = "Login successful.";
                    return RedirectToAction("Index", "Membership"); // RedirectToAction(view, controller)
                }
            }
            else
            {
                message = "Invalid user credentials.";
            }

            ModelState.AddModelError(string.Empty, message);
            return View();
        }
    }
}
