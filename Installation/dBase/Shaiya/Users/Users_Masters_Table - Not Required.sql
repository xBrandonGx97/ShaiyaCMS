USE [PS_UserData]
GO

/****** Object:  Table [dbo].[Users_Master]    Script Date: 1/5/2019 2:09:57 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Users_Master](
	[UserUID] [int] IDENTITY(1,1) NOT NULL,
	[UserID] [varchar](18) NOT NULL,
	[Pw] [varchar](32) NULL,
	[RegDate] [smalldatetime] NULL,
	[JoinDate] [smalldatetime] NOT NULL,
	[Admin] [bit] NOT NULL,
	[AdminLevel] [tinyint] NOT NULL,
	[UseQueue] [bit] NOT NULL,
	[Status] [smallint] NOT NULL,
	[Leave] [tinyint] NOT NULL,
	[LeaveDate] [smalldatetime] NOT NULL,
	[UserType] [char](1) NOT NULL,
	[UserIp] [varchar](15) NULL,
	[Point] [int] NOT NULL,
	[RegIP] [varchar](15) NULL,
	[Staff] [int] NULL,
	[Exception] [int] NULL,
 CONSTRAINT [PK_Users_Master] PRIMARY KEY CLUSTERED 
(
	[UserUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF_Users_Master_RegDate]  DEFAULT (getdate()) FOR [RegDate]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__JoinD__7849DB76]  DEFAULT (getdate()) FOR [JoinDate]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__Admin__793DFFAF]  DEFAULT ((0)) FOR [Admin]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__Admin__7A3223E8]  DEFAULT ((0)) FOR [AdminLevel]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__UseQu__7B264821]  DEFAULT ((0)) FOR [UseQueue]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__Statu__7C1A6C5A]  DEFAULT ((0)) FOR [Status]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__Leave__7D0E9093]  DEFAULT ((0)) FOR [Leave]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__Leave__7E02B4CC]  DEFAULT (getdate()) FOR [LeaveDate]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__UserT__7EF6D905]  DEFAULT ('N') FOR [UserType]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__Point__7FEAFD3E]  DEFAULT ((0)) FOR [Point]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF_Users_Master_Staff]  DEFAULT ((0)) FOR [Staff]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF_Users_Master_Exception]  DEFAULT ((0)) FOR [Exception]
GO


